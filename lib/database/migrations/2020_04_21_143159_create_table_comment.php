<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('com_id');
            $table->bigInteger('com_user')->unsigned()->nullable();
            $table->foreign("com_user")->references("id")->on("users")->onDelete("cascade");

            $table->bigInteger('com_prod')->unsigned()->nullable();
            $table->foreign('com_prod')->references('prod_id')->on('products')->onDelete('cascade');

            $table->bigInteger('com_blog')->unsigned()->nullable();
            $table->foreign('com_blog')->references('blog_id')->on('blogs')->onDelete('cascade');

            $table->text('com_content');

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
        Schema::dropIfExists('comments');
    }
}
