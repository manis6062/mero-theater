<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreenSeatCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screen_seat_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('screen_id')->unsigned();
            $table->string('category_name', 255);
            $table->string('category_from_row', 2);
            $table->string('category_to_row', 2);
            $table->timestamps();
            $table->foreign('screen_id')
                ->references('id')->on('screens')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('screen_seat_categories');
    }
}
