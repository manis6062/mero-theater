<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_tbl', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category')->unsigned();
            $table->foreign('category')->references('id')->on('category_tbl');
            $table->string('title');
            $table->text('description');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->string('featured_image');
            $table->string('caption');
            $table->string('status' , 11);
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
        Schema::dropIfExists('news_tbl');
    }
}
