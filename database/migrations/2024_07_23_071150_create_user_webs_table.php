<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWebsTable extends Migration
{
    public function up()
    {
        Schema::create('user_webs', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable(); // ทำให้ password เป็น nullable
            $table->text('profile_detail')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('line')->nullable();
            $table->string('profile_img')->default('Profile Pic/default.png');
            $table->json('rating')->nullable();
            $table->string('google_id')->nullable(); // เพิ่ม google_id เป็น nullable
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_webs');
    }
}
