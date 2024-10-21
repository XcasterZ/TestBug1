<?php

namespace App\Http\Controllers;

use App\Models\UserWeb;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Chat;
use App\Events\SomeEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ChatController extends Controller
{


    public function fetchUsers()
    {
        // ดึงข้อมูลผู้ใช้ที่ไม่ใช่ผู้ใช้ที่ล็อกอินอยู่
        $currentUser = auth()->user()->username; // ชื่อผู้ใช้ที่ล็อกอินอยู่
        $users = UserWeb::where('username', '!=', $currentUser)->get();
        return view('chat2', compact('users', 'currentUser')); // ส่งชื่อผู้ใช้ที่ล็อกอินไปยัง view
    }

    // public function getChatHistory($username)
    // {
    //     $currentUserId = auth()->user()->id;
    //     $recipient = UserWeb::where('username', $username)->firstOrFail();


    //     // ดึงประวัติการสนทนา
    //     $chats = Chat::where(function ($query) use ($currentUserId, $recipient) {
    //         $query->where('sender', $currentUserId)
    //             ->where('recipient', $recipient->id);
    //     })->orWhere(function ($query) use ($currentUserId, $recipient) {
    //         $query->where('sender', $recipient->id)
    //             ->where('recipient', $currentUserId);
    //     })->get();
    //     return response()->json($chats);
    // }

    public function getChatHistory($username)
    {
        $currentUserId = auth()->user()->id;
        $recipient = UserWeb::where('username', $username)->firstOrFail();

        // ดึงประวัติการสนทนา
        $chats = Chat::where(function ($query) use ($currentUserId, $recipient) {
            $query->where('sender', $currentUserId)
                ->where('recipient', $recipient->id);
        })->orWhere(function ($query) use ($currentUserId, $recipient) {
            $query->where('sender', $recipient->id)
                ->where('recipient', $currentUserId);
        })->get();

        // สร้างอาร์เรย์ใหม่เพื่อเก็บข้อมูลแชทพร้อม username
        $chatHistory = [];
        foreach ($chats as $chat) {
            $sender = UserWeb::find($chat->sender);
            $recipient = UserWeb::find($chat->recipient);

            $chatHistory[] = [
                'id' => $chat->id,
                'message' => $chat->message,
                'sender' => $chat->sender,
                'recipient' => $chat->recipient,
                'sender_username' => $sender ? $sender->username : 'Unknown',
                'recipient_username' => $recipient ? $recipient->username : 'Unknown',
                'image_url' => $chat->image_url,
                'product_name' => $chat->product_name,
                'product_image' => $chat->product_image,
                'product_price' => $chat->product_price,
                'product_quantity' => $chat->product_quantity,
                'seller_id' => $chat->seller_id,
                'current_url' => $chat->current_url,
            ];
        }

        return response()->json($chatHistory);
    }


    public function uploadImage(Request $request)
    {
        Log::info('Request data:', $request->all());

        try {
            // ตรวจสอบข้อมูลที่ส่งมา
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
                'recipient' => 'required|string', // เปลี่ยนเป็น string สำหรับ username
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log ข้อผิดพลาดจากการตรวจสอบ
            Log::error('Validation failed', $e->errors());
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }

        $recipient = UserWeb::where('username', $request->recipient)->first();
        if (!$recipient) {
            return response()->json(['success' => false, 'errors' => ['recipient' => ['The selected recipient is invalid.']]], 422);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                // สร้างชื่อไฟล์ที่ไม่ซ้ำกัน
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                // เก็บไฟล์ใน public/Chat_pic
                $path = $file->move(public_path('Chat_pic'), $filename);

                // สร้างบันทึกข้อความในฐานข้อมูล
                $chat = new Chat();
                $chat->sender = auth()->user()->id;
                $chat->recipient = $recipient->id; // ใช้ id ของผู้รับจากการค้นหา
                $chat->image_url = 'Chat_pic/' . $filename; // บันทึก URL ของไฟล์ภาพ
                $chat->save();

                Log::info('Chat created:', [
                    'sender' => $chat->sender,
                    'recipient' => $chat->recipient,
                    'image_url' => $chat->image_url,
                ]);

                return response()->json(['success' => true, 'imageUrl' => asset($chat->image_url)]); // ส่ง URL ที่ถูกต้องกลับไป
            } else {
                Log::error('Invalid image upload');
                return response()->json(['success' => false, 'message' => 'Invalid image upload'], 400);
            }
        }

        return response()->json(['success' => false, 'message' => 'No image uploaded'], 400);
    }

    public function sendMessage(Request $request)
    {
        // Validate ข้อมูลจาก request
        $validatedData = $request->validate([
            'message' => 'required|string',
            'recipient' => 'required|string', // Use recipient username
        ]);

        // ดึงข้อมูลของผู้รับจากฐานข้อมูล
        $recipient = UserWeb::where('username', $validatedData['recipient'])->firstOrFail();

        // บันทึกข้อความลงฐานข้อมูล
        $chat = new Chat();
        $chat->sender = auth()->user()->id; // ผู้ส่งคือผู้ใช้ที่ล็อกอินอยู่
        $chat->recipient = $recipient->id; // ผู้รับคือผู้ใช้ที่ถูกเลือก
        $chat->message = $validatedData['message'];
        $chat->save();

        return response()->json([
            'success' => true,
            'recipientId' => $recipient->id,
            'senderId' => auth()->user()->id, // ส่ง ID ผู้ส่งกลับไปด้วย
            'message' => $validatedData['message'],
            'recipientUsername' => $recipient->username, // ส่งชื่อผู้รับกลับไปด้วย
        ]);
    }


    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลก่อนบันทึก
        $validatedData = $request->validate([
            'sender' => 'required|integer', // ID ผู้ส่งต้องเป็นตัวเลข
            'recipient' => 'nullable|integer', // ID ผู้รับต้องเป็นตัวเลข
            'message' => 'nullable|string', // ข้อความสามารถเป็น null ได้ และต้องเป็น string
            // 'image_url' => 'nullable|string|max:255', // URL รูปภาพ ถ้ามี ต้องเป็น string ไม่เกิน 255 ตัวอักษร
            'product_name' => 'nullable|string|max:255', // ชื่อสินค้าสามารถเป็น null ได้
            'product_image' => 'nullable|string|max:255', // URL รูปภาพสินค้า ถ้ามี
            'product_price' => 'nullable|numeric', // ราคาสินค้าต้องเป็นตัวเลข
            'product_quantity' => 'nullable|integer', // จำนวนสินค้าต้องเป็นตัวเลข
            'current_url' => 'nullable|string|max:255', // URL รายละเอียดผลิตภัณฑ์ ถ้ามี
            'seller_id' => 'nullable|string|max:255', // ID ของผู้ขาย
        ]);

        // ใช้ Log เพื่อตรวจสอบข้อมูลที่ได้รับ
        Log::info('Received Data:', $validatedData);

        try {
            // สร้างบันทึกข้อความในฐานข้อมูล
            $chat = new Chat();
            $chat->sender = $validatedData['sender']; // ID ผู้ส่ง
            $chat->recipient = $validatedData['recipient']; // ID ผู้รับ
            $chat->message = $validatedData['message']; // ข้อความ
            // $chat->image_url = $validatedData['image_url']; // URL รูปภาพ (ถ้ามี)

            // ตรวจสอบว่ามีข้อมูลสินค้าไหม
            if (!empty($validatedData['product_name'])) {
                $chat->product_name = $validatedData['product_name'];
                $chat->product_image = $validatedData['product_image'];
                $chat->product_price = $validatedData['product_price'];
                $chat->product_quantity = $validatedData['product_quantity'];
                $chat->current_url = $validatedData['current_url'];
                $chat->seller_id = $validatedData['seller_id'];
            }

            // บันทึกลงฐานข้อมูล
            $chat->save();

            Log::info('Chat saved successfully:', ['chat' => $chat]);

            return response()->json([
                'success' => true,
                'message' => 'Message stored successfully',
                'chat' => $chat,
            ], 200);
        } catch (\Exception $e) {
            // ใช้ Log เพื่อตรวจสอบข้อผิดพลาด
            Log::error('Error occurred while storing chat:', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Database error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
