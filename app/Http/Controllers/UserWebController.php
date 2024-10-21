<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\UserWeb;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;



use App\Mail\OtpMail;




class UserWebController extends Controller
{
    // --------------------- Auth Register Login Logout --------------------
    // public function store(Request $request)
    // {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'username' => 'required|string|max:255|unique:user_webs',
    //         'password' => 'nullable|string|min:8',
    //         'email' => 'required|string|email|max:255|unique:user_webs',
    //         'phone_number' => 'required|string|max:15',
    //         'first_name' => 'nullable|string|max:255',
    //         'last_name' => 'nullable|string|max:255',
    //         'profile_detail' => 'nullable|string',
    //         'facebook' => 'nullable|url|max:255',
    //         'instagram' => 'nullable|url|max:255',
    //         'line' => 'nullable|url|max:255',
    //         'google_id' => 'nullable|string|max:255',
    //     ]);

    //     // Create a new user
    //     $user = UserWeb::create([
    //         'username' => $validatedData['username'],
    //         'password' => $validatedData['password'] ?? null,
    //         'email' => $validatedData['email'],
    //         'phone_number' => $validatedData['phone_number'] ?? null,
    //         'first_name' => $validatedData['first_name'] ?? null,
    //         'last_name' => $validatedData['last_name'] ?? null,
    //         'profile_detail' => $validatedData['profile_detail'] ?? null,
    //         'facebook' => $validatedData['facebook'] ?? null,
    //         'instagram' => $validatedData['instagram'] ?? null,
    //         'line' => $validatedData['line'] ?? null,
    //         'google_id' => $validatedData['google_id'] ?? null,
    //         'profile_img' => 'Profile Pic/default.png',
    //     ]);

    //     $otp = rand(100000, 999999);

    //     // ส่ง OTP ไปยังอีเมล
    //     Mail::to($validatedData['email'])->send(new OtpMail($otp));

    //     // บันทึก OTP ลงใน session
    //     session(['otp' => $otp]);

    //     // ไม่ให้เข้าสู่ระบบที่นี่
    //     return response()->json(['success' => true, 'otp_required' => true]);
    // }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:user_webs',
            'password' => 'nullable|string|min:8',
            'email' => 'required|string|email|max:255|unique:user_webs',
            'phone_number' => 'required|string|max:15',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'profile_detail' => 'nullable|string',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'line' => 'nullable|url|max:255',
            'google_id' => 'nullable|string|max:255',
        ]);

        // บันทึกข้อมูลลงใน session
        session(['validatedData' => $validatedData]);

        // สร้าง OTP
        $otp = rand(100000, 999999);

        // ส่ง OTP ไปยังอีเมล
        Mail::to($validatedData['email'])->send(new OtpMail($otp));

        // บันทึก OTP ลงใน session
        session(['otp' => $otp]);

        return response()->json(['success' => true, 'otp_required' => true]);
    }


    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|integer', 'email' => 'required|string|email']);

        // ตรวจสอบ OTP กับที่เก็บใน session
        if ($request->otp == session('otp')) {
            // ถ้า OTP ถูกต้อง ให้สร้างผู้ใช้
            $validatedData = session('validatedData'); // ดึงข้อมูลที่บันทึกไว้ใน session
            $validatedData['password'] = $validatedData['password'] ?? null; // ใส่รหัสผ่านถ้ามี

            // สร้างผู้ใช้ใหม่ โดยไม่ hash รหัสผ่าน
            UserWeb::create($validatedData);

            // ลบ OTP และข้อมูลที่ใช้ในการสมัครออกจาก session
            session()->forget('otp');
            session()->forget('validatedData');

            return response()->json(['success' => true, 'message' => 'Registration successful.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP.'], 400);
    }

    public function checkExistingData(Request $request)
    {
        $userId = $request->id; // Current user's ID

        $existsUsername = UserWeb::where('username', $request->username)
            ->where('id', '!=', $userId)
            ->exists();
        $existsEmail = UserWeb::where('email', $request->email)
            ->where('id', '!=', $userId)
            ->exists();

        $isSameUsername = UserWeb::where('username', $request->username)
            ->where('id', $userId)
            ->exists();
        $isSameEmail = UserWeb::where('email', $request->email)
            ->where('id', $userId)
            ->exists();

        return response()->json([
            'existsUsername' => $existsUsername,
            'existsEmail' => $existsEmail,
            'isSameUsername' => $isSameUsername,
            'isSameEmail' => $isSameEmail
        ]);
    }

    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string', // ยังคงบังคับให้ใส่รหัสผ่านในกรณีนี้
        ]);

        // Attempt to find the user
        $user = UserWeb::where('username', $request->username)->first();

        // Verify the password
        if ($user && $user->password && $request->password === $user->password) {
            // Authentication passed
            Auth::login($user);
            return response()->json(['success' => true]);
        } else {
            // Authentication failed
            return response()->json(['success' => false]);
        }
    }

    public function logout(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token
        $request->session()->regenerateToken();

        // Redirect to the homepage
        return redirect('/');
    }

    // ------------------ Profile -----------------------
    public function edit()
    {
        $user = Auth::user(); // ดึงข้อมูลของผู้ใช้ที่ล็อกอินอยู่

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to access this page');
        }

        $ratings = json_decode($user->rating, true);

        // ตรวจสอบว่าค่าของ $ratings เป็น array และไม่เป็น null
        if (is_array($ratings)) {
            $averageRating = floor(array_sum($ratings) / count($ratings));
        } else {
            $averageRating = 0;
        }

        return view('profile.profile', compact('user', 'averageRating')); // ส่งข้อมูลไปยัง view
    }

    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'profile_detail' => 'nullable|string',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'line' => 'nullable|url|max:255',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        if ($user) {
            // Update user details using the update method
            $user->update([
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'first_name' => $validatedData['first_name'] ?? null,
                'last_name' => $validatedData['last_name'] ?? null,
                'phone_number' => $validatedData['phone_number'] ?? null,
                'profile_detail' => $validatedData['profile_detail'] ?? null,
                'facebook' => $validatedData['facebook'] ?? null,
                'instagram' => $validatedData['instagram'] ?? null,
                'line' => $validatedData['line'] ?? null,
            ]);

            // Redirect with success message
            return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
        } else {
            return redirect()->route('profile.edit')->with('error', 'User not found');
        }
    }

    public function checkOldPassword(Request $request)
    {
        $user = Auth::user();
        $oldPassword = $request->input('old_password');

        // ตรวจสอบว่ารหัสผ่านเก่าถูกต้องหรือไม่
        if ($oldPassword === $user->password) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 400);
        }
    }



    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|string|min:8',
        ]);

        $user = Auth::user();
        $newPassword = $request->input('new_password');

        // อัปเดตรหัสผ่านใหม่โดยไม่ hash
        $user->password = $newPassword;
        $user->save();

        return response()->json(['success' => true]);
    }

    // UserWebController.php



    // --------------------- Layout Profiles --------------------
    public function updateProfileImg(Request $request)
    {
        $request->validate([
            'profile_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $user = Auth::user();

        // Check if a file was uploaded
        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Move the uploaded file to 'Profile Pic' directory
            $file->move(public_path('Profile Pic'), $filename);

            // Update the user's profile_img field in the database
            $user->profile_img = 'Profile Pic/' . $filename;
            $user->save();

            return response()->json([
                'success' => 'Profile image updated successfully',
                'profile_img' => 'Profile Pic/' . $filename
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    } // สร้างคลาส Mail สำหรับ OTP

}
