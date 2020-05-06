<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->bigIncrements('cart_id');
            $table->bigInteger('cart_user')->unsigned()->nullable();
            $table->foreign('cart_user')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('cart_prod')->unsigned()->nullable();
            $table->foreign('cart_prod')->references('prod_id')->on('products')->onDelete('cascade');

            $table->tinyInteger('cart_quantity')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
