<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable; // เพิ่มบรรทัดนี้


class UserWeb extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Notifiable;

    protected $fillable = [
        'username', 'password', 'email', 'phone_number', 
        'first_name', 'last_name', 'profile_detail', 
        'facebook', 'instagram', 'line', 'google_id',
        'facebook_id', 
        'profile_img'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // กำหนดให้ rating เป็น JSON
    protected $casts = [
        'rating' => 'array',
    ];
}
