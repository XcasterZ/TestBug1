<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

// กำหนดการอนุญาตเข้าถึงช่องทาง private-chat
Broadcast::channel('private-chat.{userId}', function ($userId) {
    return Auth::check() && Auth::id() === (int) $userId; // ตรวจสอบการล็อกอินและ ID
});

// กำหนดการอนุญาตเข้าถึงช่องทาง presence-chat
Broadcast::channel('presence-chat.{userId}', function ($userId) {
    return Auth::check() && Auth::id() === (int) $userId; // ตรวจสอบการล็อกอินและ ID
});

Broadcast::channel('presence-chat.{userId}', function ($userId) {
    if (Auth::check()) {
        Log::info("User is authenticated: " . Auth::id());
        return Auth::id() === (int) $userId; // อนุญาตให้ผู้ใช้ที่ล็อกอินเข้าถึงช่องทางของตัวเอง
    }
    Log::warning("User is not authenticated.");
    return false;
}); 
