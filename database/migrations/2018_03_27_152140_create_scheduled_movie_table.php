<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduledMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_movie', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned();
            $table->integer('movie_id')->unsigned();
            $table->integer('screen_id')->unsigned();
            $table->string('show_time_start', 10);
            $table->string('show_time_end', 10);
            $table->integer('clean_up_time');
            $table->string('total_occupied_time', 100);
            $table->string('show_date', 100);
            $table->string('show_day', 100);
            $table->string('price_card_name', 255);
            $table->string('seat_categories_with_price', 255);
            $table->string('sales_via', 1000);
            $table->string('seating', 255);
            $table->string('comps', 255);
            $table->string('status', 255);
            $table->string('show_type', 255);
            $table->timestamps();
            $table->foreign('admin_id')
                ->references('id')->on('admin_tbl')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('movie_id')
                ->references('id')->on('movie_tbl')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('scheduled_movie');
    }
}
