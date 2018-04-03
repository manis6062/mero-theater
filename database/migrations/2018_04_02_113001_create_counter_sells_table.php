<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounterSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter_sells', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket_id');
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
            $table->string('invoice_number');
            $table->string('qr_code');
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
        Schema::dropIfExists('counter_sells');
    }
}
