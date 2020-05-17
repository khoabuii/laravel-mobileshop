<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBillDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billsDetail', function (Blueprint $table) {
            $table->bigIncrements('detail_id');
            $table->bigInteger("bill_id")->unsigned()->nullable();
            $table->foreign("bill_id")->references("bill_id")->on("bills")->onDelete("cascade");
            $table->string("prod_name")->nullable();
            $table->string("prod_price")->nullable();
            $table->string("quantity")->nullable();
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
        Schema::dropIfExists('billsDetail');
    }
}
