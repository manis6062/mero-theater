<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounetrReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('screen_id');
            $table->integer('movie_id');
            $table->integer('schedule_id');
            $table->integer('counter_id');
            $table->string('show_date');
            $table->string('show_time');
            $table->string('show_day');
            $table->string('seat_name');
            $table->string('seat_category');
            $table->string('seat_price');
            $table->string('customer_name')->nullable();
            $table->string('customer_pan_number')->nullable();
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
        Schema::dropIfExists('counetr_reservations');
    }
}
