<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\UserWeb;


use Carbon\Carbon;

class ProductController extends Controller
{
    public function shop()
    {
        $products = Product::whereNotNull('quantity')
            ->whereNull('time')
            ->whereNull('date')
            ->get();

        return view('products.shop', compact('products'));
    }

    public function auction()
    {
        // แสดงสินค้าที่ประมูลทั้งหมด
        // $products = Product::whereNotNull('date')
        //     ->whereNotNull('time')
        //     ->whereNull('quantity')
        //     ->get();

        // return view('products.auction', compact('products'));

        // แสดงสินค้าที่ประมูล ที่ยังไม่หมดเวลา
        $now = now(); // เวลาในปัจจุบัน

        $products = Product::whereNotNull('date')
            ->whereNotNull('time')
            ->whereNull('quantity')
            ->where(function ($query) use ($now) {
                $query->where('countdown', '>', 0)
                    ->orWhereNull('countdown');
            })
            ->get();

        return view('products.auction', compact('products'));
    }

    public function sell()
    {
        $products = Product::where('user_id', auth()->user()->id)->get();
        $user = Auth::user(); // ดึงข้อมูลของผู้ใช้ที่ล็อกอินอยู่

        $ratings = json_decode($user->rating, true);

        // ตรวจสอบว่าค่าของ $ratings เป็น array และไม่เป็น null
        if (is_array($ratings)) {
            $averageRating = floor(array_sum($ratings) / count($ratings));
        } else {
            $averageRating = 0;
        }

        return view('profile.sell', compact('products', 'averageRating')); // ส่งข้อมูลไปยัง view
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('profile.sell')->with('success', 'Product deleted successfully.');
    }


    public function store(Request $request)
    {
        // ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบ
        if (!auth()->check()) {
            return redirect(route('login'))->with('error', 'You must be logged in to add a product.');
        }

        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'nullable',
            'quantity' => 'nullable|integer|required_if:select_sale,0',
            'date' => 'nullable|date|required_if:select_sale,1',
            'time' => 'nullable|date_format:H:i|required_if:select_sale,1',
            'selection_group' => 'required',
            'selection_district' => 'required',
            'payment_method_1' => 'nullable|boolean',
            'payment_method_2' => 'nullable|boolean',
            'payment_method_3' => 'nullable|boolean',
            'payment_method_4' => 'nullable|boolean',
        ], [
            'quantity.required_if' => 'The quantity field is required when sale is not selected.',
            'date.required_if' => 'The date field is required when sale is selected.',
            'time.required_if' => 'The time field is required when sale is selected.',
        ]);

        $data['user_id'] = auth()->user()->id;

        if (!empty($data['date']) && !empty($data['time'])) {
            $datetime = Carbon::parse($data['date'] . ' ' . $data['time']);
            $countdown = $datetime->diffInSeconds(now());
            $data['countdown'] = $countdown;
        } else {
            $data['countdown'] = null;
        }

        // Handle file uploads
        $filePaths = [];
        for ($i = 1; $i <= 5; $i++) {
            $fileKey = "img_vdo_$i";
            if ($request->hasFile($fileKey)) {
                $filePaths["file_path_$i"] = $request->file($fileKey)->store('uploads', 'public');
            } else {
                $filePaths["file_path_$i"] = null;
            }
        }

        $data = array_merge($data, $filePaths);

        // Handle payment methods
        $paymentMethods = [
            'payment_method_1' => $request->input('payment_method_1', false) ? 'cash_on_delivery' : null,
            'payment_method_2' => $request->input('payment_method_2', false) ? 'mobile_bank' : null,
            'payment_method_3' => $request->input('payment_method_3', false) ? 'true_money_wallet' : null,
            'payment_method_4' => $request->input('payment_method_4', false) ? 'scheduled_pickup' : null,
        ];
        $data['payment_methods'] = json_encode(array_filter($paymentMethods)); // Remove null values

        // If quantity, date or time is empty, set it to null
        $data['quantity'] = $data['quantity'] ?? null;
        $data['date'] = $data['date'] ?? null;
        $data['time'] = $data['time'] ?? null;

        // สร้างออบเจ็กต์ Product ใหม่
        Product::create($data);

        return redirect(route('profile.sell'))->with('success', 'Product and files uploaded successfully.');
    }




    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'nullable',
            'quantity' => 'nullable|integer|required_if:select_sale,0',
            'date' => 'nullable|date|required_if:select_sale,1',
            'time' => 'nullable|date_format:H:i|required_if:select_sale,1',
            'selection_group' => 'required',
            'selection_district' => 'required',
            'payment_method_1' => 'nullable|boolean',
            'payment_method_2' => 'nullable|boolean',
            'payment_method_3' => 'nullable|boolean',
            'payment_method_4' => 'nullable|boolean',
        ], [
            'quantity.required_if' => 'The quantity field is required when sale is not selected.',
            'date.required_if' => 'The date field is required when sale is selected.',
            'time.required_if' => 'The time field is required when sale is selected.',
        ]);

        if (!empty($data['date']) && !empty($data['time'])) {
            $datetime = Carbon::parse($data['date'] . ' ' . $data['time']);
            $countdown = $datetime->diffInSeconds(now());
            $data['countdown'] = $countdown;
        } else {
            $data['countdown'] = null;
        }

        // Handle file uploads and deletions
        for ($i = 1; $i <= 5; $i++) {
            $fileKey = "img_vdo_$i";
            if ($request->hasFile($fileKey)) {
                if ($product->{"file_path_$i"}) {
                    Storage::disk('public')->delete($product->{"file_path_$i"});
                }
                $data["file_path_$i"] = $request->file($fileKey)->store('uploads', 'public');
            } else {
                $data["file_path_$i"] = $product->{"file_path_$i"};
            }
        }

        if ($request->has('delete_file')) {
            foreach ($request->input('delete_file') as $filePath) {
                $filePath = trim($filePath);
                if ($filePath) {
                    Storage::disk('public')->delete($filePath);
                    foreach ($data as $key => $path) {
                        if ($path === $filePath) {
                            $data[$key] = null;
                        }
                    }
                }
            }
        }

        // Handle payment methods
        $paymentMethods = [
            'payment_method_1' => $request->input('payment_method_1', false) ? 'cash_on_delivery' : null,
            'payment_method_2' => $request->input('payment_method_2', false) ? 'mobile_bank' : null,
            'payment_method_3' => $request->input('payment_method_3', false) ? 'true_money_wallet' : null,
            'payment_method_4' => $request->input('payment_method_4', false) ? 'scheduled_pickup' : null,
        ];

        $data['payment_methods'] = json_encode(array_filter($paymentMethods));

        // If quantity, date or time is empty, set it to null
        $data['quantity'] = $data['quantity'] ?? null;
        $data['date'] = $data['date'] ?? null;
        $data['time'] = $data['time'] ?? null;

        // Add username
        // $data['username'] = auth()->user()->username;

        $data['user_id'] = auth()->user()->id;


        $product->update($data);

        return redirect()->route('profile.sell')->with('success', 'Product updated successfully');
    }

    public function getDistrictOptions()
    {
        $filename = storage_path('app/district.txt');
        $districts = [];

        if (file_exists($filename)) {
            $file = fopen($filename, 'r');

            while (($line = fgets($file)) !== false) {
                $district = trim($line);
                if ($district) {
                    $districts[] = $district;
                }
            }

            fclose($file);
        }

        // เรียงตามตัวอักษร
        sort($districts);

        // สร้าง HTML ตัวเลือก
        $options = '';
        foreach ($districts as $district) {
            $options .= "<option value=\"$district\">$district</option>\n";
        }

        return $options;
    }

    public function getGroupOptions()
    {
        $filename = storage_path('app/group.txt');
        $groups = [];

        if (file_exists($filename)) {
            $file = fopen($filename, 'r');

            while (($line = fgets($file)) !== false) {
                $group = trim($line);
                if ($group) {
                    $groups[] = $group;
                }
            }

            fclose($file);
        }

        // เรียงตามตัวอักษร
        sort($groups);

        // สร้าง HTML ตัวเลือก
        $options = '';
        foreach ($groups as $group) {
            $options .= "<option value=\"$group\">$group</option>\n";
        }

        return $options;
    }

    public function filterProducts(Request $request)
    {
        // รับค่าจาก query string
        $selectionGroups = $request->input('selection_groups', []);
        $selectionDistricts = $request->input('selection_districts', []);
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', 10000000);
        $sortOrder = $request->input('sort_order', 'default');

        // กรองสินค้าตามค่าที่เลือก
        $products = Product::query();

        if (!empty($selectionGroups) || !empty($selectionDistricts)) {
            $products->where(function ($query) use ($selectionGroups, $selectionDistricts) {
                if (!empty($selectionGroups)) {
                    $query->whereIn('selection_group', $selectionGroups);
                }
                if (!empty($selectionDistricts)) {
                    $query->whereIn('selection_district', $selectionDistricts);
                }
            })->whereNotNull('quantity')
                ->whereNull('time')
                ->whereNull('date');
        } else {
            $products->whereNotNull('quantity')
                ->whereNull('time')
                ->whereNull('date');
        }

        $products->whereBetween('price', [$minPrice, $maxPrice]);

        switch ($sortOrder) {
            case 'low_to_high':
                $products->orderBy('price', 'asc');
                break;
            case 'high_to_low':
                $products->orderBy('price', 'desc');
                break;
            case 'oldest':
                $products->orderBy('created_at', 'asc');
                break;
            case 'newest':
                $products->orderBy('created_at', 'desc');
                break;
            default:
                // เรียงตามค่าเริ่มต้น (หากมี)
                break;
        }

        $products = $products->get();

        // ตรวจสอบถ้ามีสินค้าหรือไม่
        if ($products->isEmpty()) {
            return response()->json(['products' => []]);
        }

        // ส่งข้อมูลกลับเป็น JSON
        return response()->json(['products' => $products]);
    }





    public function filterAuctions(Request $request)
    {
        $selectionGroups = $request->input('selection_groups', []);
        $selectionDistricts = $request->input('selection_districts', []);
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', 10000000);
        $sortOrder = $request->input('sort_order', 'default');

        $now = now(); // เวลาในปัจจุบัน

        // เริ่มสร้างคิวรี
        $products = Product::query()
            ->whereNotNull('date')
            ->whereNotNull('time')
            ->whereNull('quantity')
            ->where(function ($query) use ($now) {
                $query->where('countdown', '>', 0)
                    ->orWhereNull('countdown');
            });

        // เงื่อนไขการกรองตามกลุ่มและเขต
        if (!empty($selectionGroups) || !empty($selectionDistricts)) {
            $products->where(function ($query) use ($selectionGroups, $selectionDistricts) {
                if (!empty($selectionGroups)) {
                    $query->whereIn('selection_group', $selectionGroups);
                }
                if (!empty($selectionDistricts)) {
                    $query->whereIn('selection_district', $selectionDistricts);
                }
            });
        }

        // กรองราคาสินค้า
        $products->whereBetween('price', [$minPrice, $maxPrice]);

        // จัดเรียงสินค้าตามคำสั่งที่เลือก
        switch ($sortOrder) {
            case 'low_to_high':
                $products->orderBy('price', 'asc');
                break;
            case 'high_to_low':
                $products->orderBy('price', 'desc');
                break;
            case 'oldest':
                $products->orderBy('created_at', 'asc');
                break;
            case 'newest':
                $products->orderBy('created_at', 'desc');
                break;
            default:
                break;
        }

        // ดึงข้อมูลสินค้าจากฐานข้อมูล
        $products = $products->get();

        // ตรวจสอบว่ามีสินค้าหรือไม่
        if ($products->isEmpty()) {
            return response()->json(['products' => []]);
        }

        // ส่งข้อมูลกลับเป็น JSON
        return response()->json(['products' => $products]);
    }


    public function showshop($id)
    {
        // ดึงข้อมูลผลิตภัณฑ์โดยใช้ ID
        $product = Product::findOrFail($id);

        // ดึงข้อมูลผู้ใช้ที่เกี่ยวข้อง
        $user = UserWeb::find($product->user_id);
        // dd($product, $user);
        // ส่งข้อมูลผลิตภัณฑ์และผู้ใช้ไปยัง View
        return view('products.product_showshop', [
            'product' => $product,
            'user' => $user
        ]);
    }

    public function showauction($id)
    {
        // ดึงข้อมูลผลิตภัณฑ์โดยใช้ ID
        $product = Product::findOrFail($id);

        // ดึงข้อมูลผู้ใช้ที่เกี่ยวข้อง
        $user = UserWeb::find($product->user_id);

        // ส่งข้อมูลผลิตภัณฑ์และผู้ใช้ไปยัง View
        return view('products.product_showauction', [
            'product' => $product,
            'user' => $user
        ]);
    }

    public function getRecommendedProducts()
    {
        // ดึงข้อมูลผลิตภัณฑ์ที่มี quantity มากกว่าศูนย์
        $recommendedProducts = Product::whereNotNull('quantity')
            ->whereNull('time')
            ->whereNull('date')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('index', compact('recommendedProducts'));
    }
}
