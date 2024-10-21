<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id(); // primary key
            $table->unsignedBigInteger('sender'); // ID ผู้ส่ง
            $table->unsignedBigInteger('recipient'); // ID ผู้รับ
            $table->string('message')->nullable(); // ข้อความ อาจเป็น null ได้
            $table->string('image_url', 255)->nullable(); // URL รูปภาพ
            $table->string('product_name')->nullable(); // ชื่อผลิตภัณฑ์
            $table->string('product_image')->nullable(); // รูปผลิตภัณฑ์
            $table->decimal('product_price', 10, 2)->nullable(); // ราคาผลิตภัณฑ์
            $table->integer('product_quantity')->nullable(); // จำนวนผลิตภัณฑ์
            $table->string('current_url')->nullable(); // URL รายละเอียดผลิตภัณฑ์
            $table->string('seller_id')->nullable(); // ID ผู้ขาย เก็บเป็น string
            $table->timestamps(); // created_at และ updated_at

            // เพิ่ม foreign key constraints
            $table->foreign('sender')->references('id')->on('user_webs')->onDelete('cascade');
            $table->foreign('recipient')->references('id')->on('user_webs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chats');
    }
};
