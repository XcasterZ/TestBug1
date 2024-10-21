<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BroadcastingController extends Controller
{
    public function authenticate(Request $request)
    {
        if (Auth::check()) {
            // หากผู้ใช้ล็อกอิน
            return response()->json([
                'auth' => true,
                'user_id' => Auth::id(),
            ]);
        }

        // หากผู้ใช้ไม่ได้ล็อกอิน
        Log::warning("Broadcasting authentication failed: User is not authenticated.");
        return response()->json(['error' => 'User is not authenticated.'], 403);
    }
}
