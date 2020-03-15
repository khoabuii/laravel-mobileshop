<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            //
            $table->bigIncrements("prod_id");
            $table->string("prod_name");
            $table->string("prod_slug");
            $table->integer("prod_price");
            $table->integer("prod_promotion_price")->nullable();
            $table->string("prod_img");
            $table->tinyInteger("prod_warranty");
            $table->string("prod_promotion");
            $table->string("prod_accessories");
            $table->string("prod_condition");
            $table->tinyInteger("prod_status");
            $table->text("prod_description");
            $table->tinyInteger("prod_feature")->nullable();
            $table->bigInteger("prod_cate")->unsigned();
            $table->foreign("prod_cate")->references("cate_id")->on("category")->onDelete("cascade");

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
        Schema::dropIfExists('products');
            //

    }
}
