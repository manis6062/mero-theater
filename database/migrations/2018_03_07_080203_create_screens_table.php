<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned();
            $table->string('name', 100);
            $table->integer('screen_number');
            $table->integer('house_seats');
            $table->integer('wheel_chair_seats');
            $table->integer('standard_seats')->nullable();
            $table->string('selected_seat', 100);
            $table->string('reserved_seat', 100);
            $table->string('sold_seat', 100);
            $table->string('available_seat', 100);
            $table->string('slug', 100);
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admin_tbl')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('screens');
    }
}
