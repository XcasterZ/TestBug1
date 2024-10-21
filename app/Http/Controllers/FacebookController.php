<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\UserWeb; // นำเข้า Model UserWeb
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            // สร้าง username โดยลบเว้นวรรคออก
            $username = preg_replace('/\s+/', '', $facebookUser->getName());

            // ตรวจสอบ username ว่ามีอยู่ในระบบหรือไม่
            $baseUsername = $username;
            $count = 1;

            while (UserWeb::where('username', $username)->exists()) {
                $username = $baseUsername . $count; // เพิ่มเลขต่อท้าย
                $count++;
            }

            // ตรวจสอบว่ามีผู้ใช้ที่ลงทะเบียนด้วย Facebook หรือไม่
            $user = UserWeb::where('facebook_id', $facebookUser->getId())
                ->orWhere('email', $facebookUser->getEmail())
                ->first();

            if (!$user) {
                // สร้างผู้ใช้ใหม่
                $user = UserWeb::create([
                    'username' => $username, // ใช้ username ที่สร้างขึ้นใหม่
                    'email' => $facebookUser->getEmail() ?: 'user_' . Str::random(8) . '@example.com', // จัดการกรณีไม่มีอีเมล
                    'facebook_id' => $facebookUser->getId(),
                    'profile_img' => $facebookUser->getAvatar(),
                    'password' => null,
                ]);
            }

            Auth::login($user);

            return redirect()->route('home')->with('success', 'Logged in with Facebook!');
        } catch (\Exception $th) {
            Log::error('Facebook login error: ' . $th->getMessage());

            return redirect()->route('login')->with('error', 'Something went wrong during Facebook login. Please try again.');
        }
    }
}
