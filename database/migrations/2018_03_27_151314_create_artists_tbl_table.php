<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistsTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists_tbl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('artists_name', 255);
            $table->string('artists_avatar', 255);
            $table->text('artists_achievements');
            $table->text('artists_current_status');
            $table->text('artists_early_life');
            $table->string('hashtag', 255);
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
        Schema::dropIfExists('artists_tbl');
    }
}
