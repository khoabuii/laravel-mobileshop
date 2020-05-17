<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('bill_id');
            $table->bigInteger('bill_user')->unsigned()->nullable();
            $table->foreign("bill_user")->references("id")->on("users")->onDelete("cascade");
            $table->integer('bill_total')->nullable();
            $table->string('bill_address')->nullable();
            $table->tinyInteger("bill_status")->nullable();
            $table->integer("bill_phone");
            $table->text("bill_note");
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
        Schema::dropIfExists('bills');
    }
}
