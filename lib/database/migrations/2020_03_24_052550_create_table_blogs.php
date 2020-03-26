<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBlogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            //
            $table->bigIncrements("blog_id");
            $table->string('blog_title');
            $table->string('blog_slug');
            $table->string('blog_summary');
            $table->text('blog_content');
            $table->string('blog_img');
            $table->integer('blog_view')->default(0);
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
        Schema::dropIfExists('blogs');
            //

    }
}
