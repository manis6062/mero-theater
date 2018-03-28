<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreenSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screen_seats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned();
            $table->integer('screen_id')->unsigned();
            $table->integer('num_rows');
            $table->integer('num_columns');
            $table->longText('active_seats');
            $table->longText('path');
            $table->string('seat_direction');
            $table->string('alphabet_direction');
            $table->string('alphabets');
            $table->integer('total_seats');
            $table->integer('num_of_seat_categories');
            $table->timestamps();
            $table->foreign('admin_id')
                ->references('id')->on('admin_tbl')
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
        Schema::dropIfExists('screen_seats');
    }
}
