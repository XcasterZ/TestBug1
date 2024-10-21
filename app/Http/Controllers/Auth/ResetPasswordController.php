<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Passwords\CanResetPassword; // ใช้ trait นี้แทน
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    use CanResetPassword;

    protected $redirectTo = '/'; // กำหนดเส้นทางหลังจากรีเซ็ตรหัสผ่านเสร็จ

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
{
    $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
        'token' => 'required',
    ]);

    $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
        $user->password = $password; // ใช้รหัสผ่านที่ได้รับ
        $user->save();
    });

    if ($response == Password::PASSWORD_RESET) {
        return response()->json(['status' => trans($response)], 200); // ส่ง JSON กลับไป
    }

    return response()->json(['error' => trans($response)], 422); // ส่ง JSON พร้อมข้อผิดพลาด
}

}
