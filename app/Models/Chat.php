<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    // ระบุชื่อตารางถ้าจำเป็น
    protected $table = 'chats';

    // ระบุฟิลด์ที่สามารถเติมข้อมูลได้
    protected $fillable = ['sender', 'recipient', 'message'];
 
    // ถ้าคุณต้องการระบุความสัมพันธ์กับโมเดล User
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient');
    }
}
