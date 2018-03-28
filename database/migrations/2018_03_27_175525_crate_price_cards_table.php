<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CratePriceCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned();
            $table->string('name' , 255);
            $table->integer('screen_ids')->unsigned();
            $table->string('seat_categories', 1000);
            $table->string('selected_days' , 255);
            $table->string('time_range' , 255);
            $table->integer('min_time_range');
            $table->integer('max_time_range');
            $table->string('ticket_types_ids', 255);
            $table->string('sequences', 255);
            $table->string('prices', 255);
            $table->enum('status', ['active', 'inactive']);
            $table->string('slug', 255);
            $table->timestamps();
            $table->foreign('admin_id')
                ->references('id')->on('admin_tbl')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('screen_ids')
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
        //
    }
}
