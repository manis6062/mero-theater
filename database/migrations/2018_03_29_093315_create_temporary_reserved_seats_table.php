<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporaryReservedSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_reserved_seats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('screen_id');
            $table->integer('movie_id');
            $table->string('show_date');
            $table->string('show_time');
            $table->string('seat', 10);
            $table->enum('processed_by', ['counter', 'user']);
            $table->integer('counter_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('unique_hold_id');
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
        Schema::dropIfExists('temporary_reserved_seats');
    }
}
