<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\UserWeb; // นำเข้า Model UserWeb
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // นำเข้า Log
use Illuminate\Support\Str; // นำเข้า Str เพื่อใช้งานกับ random string

class GoogleController extends Controller
{
    public function redirect()
    {
        // ส่งผู้ใช้ไปยัง Google สำหรับการอนุญาต
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            // รับข้อมูลผู้ใช้จาก Google
            $googleUser = Socialite::driver('google')->user();

            // ค้นหาผู้ใช้ตาม google_id หรืออีเมล
            $user = UserWeb::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if (!$user) {
                // ใช้ given_name เป็น base ของ username
                $baseUsername = $googleUser->user['given_name']; 
                $username = $baseUsername;
                $counter = 1;

                // ตรวจสอบว่า given_name เป็นภาษาอังกฤษหรือไม่
                if (!preg_match('/^[a-zA-Z]+$/', $baseUsername)) {
                    // ถ้าไม่ใช่ภาษาอังกฤษ ให้ random username 8 ตัวอักษร
                    $username = Str::random(8);
                }

                // วนลูปเพื่อหาชื่อที่ไม่ซ้ำกัน
                while (UserWeb::where('username', $username)->exists()) {
                    $username = $baseUsername . $counter;
                    $counter++;
                }

                // หากไม่มีผู้ใช้ ให้สร้างผู้ใช้ใหม่
                $new_user = UserWeb::create([
                    'username' => $username, // ตั้งค่า username ที่ตรวจสอบแล้วว่าไม่ซ้ำ
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'first_name' => $googleUser->user['given_name'], // ใช้ given_name เป็น first_name
                    'last_name' => $googleUser->user['family_name'], // ใช้ family_name เป็น last_name
                    'profile_img' => $googleUser->getAvatar(), // ใช้ picture เป็น profile_img
                    'password' => null, // ตั้งค่า password เป็น null
                ]);

                // ล็อกอินผู้ใช้ใหม่
                Auth::login($new_user);

                return redirect()->route('home')->with('success', 'Logged in successfully!');
            } else {
                // ล็อกอินผู้ใช้ที่มีอยู่แล้ว
                Auth::login($user);
                return redirect()->route('home')->with('success', 'Logged in successfully!');
            }
        } catch (\Exception $th) {
            // บันทึกข้อผิดพลาดใน Log
            Log::error('Google login error: ' . $th->getMessage());

            return redirect()->route('login')->with('error', 'Something went wrong during Google login. Please try again.');
        }
    }
}
