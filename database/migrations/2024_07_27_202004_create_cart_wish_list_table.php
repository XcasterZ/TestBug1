<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartWishListTable extends Migration
{
    public function up()
    {
        Schema::create('cart_wish_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->json('cart_product_ids')->nullable();
            $table->json('cart_product_quantities')->nullable();
            $table->json('wish_list_product_ids')->nullable();
            $table->json('add_cart_date')->nullable();
            $table->json('add_wish_list_date')->nullable();
            $table->foreign('id_user')->references('id')->on('user_webs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_wish_list');
    }
}
