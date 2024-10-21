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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // id
	        $table->unsignedBigInteger('user_id')->nullable();        
            $table->string('name');
            $table->integer('price');
            $table->integer('quantity')->nullable(); // Allow null values
            $table->date('date')->nullable(); // Allow null values
            $table->time('time')->nullable(); // Allow null values
            $table->text('description')->nullable(); // Allow null values
            $table->string('selection_group')->nullable();
            $table->string('selection_district')->nullable();
            $table->timestamps(); // created_at and updated_at
            $table->string('file_path_1')->nullable();
            $table->string('file_path_2')->nullable();
            $table->string('file_path_3')->nullable();
            $table->string('file_path_4')->nullable();
            $table->string('file_path_5')->nullable();
            $table->json('payment_methods')->nullable();
            $table->timestamp('countdown')->nullable();

            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('user_webs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop foreign key constraint
        });
        Schema::dropIfExists('products');
    }
};

