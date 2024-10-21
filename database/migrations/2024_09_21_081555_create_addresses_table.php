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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('province');
            $table->string('district');
            $table->string('subdistrict');
            $table->string('post_code');
            $table->text('additional_details')->nullable();
            $table->timestamps();

            // สร้าง foreign key เชื่อมโยงไปยังตาราง user_webs
            $table->foreign('user_id')->references('id')->on('user_webs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
