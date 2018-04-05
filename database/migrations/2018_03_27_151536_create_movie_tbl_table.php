<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_tbl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('movie_title', 255);
            $table->string('movie_short_name', 255);
            $table->text('synopsis');
            $table->string('genre');
            $table->string('distributor');
            $table->date('openingdate');
            $table->string('content', 255)->nullable();
            $table->integer('duration');
            $table->string('isrestricted', 200)->nullable();
            $table->integer('displaysequence');
            $table->string('filmformat', 200);
            $table->string('trailerurl', 500);
            $table->string('image', 255);
            $table->string('banner_image', 255);
            $table->string('status', 11);
            $table->string('direct_artist', 500)->nullable();
            $table->string('artists_from_db', 1000)->nullable();
            $table->string('rating', 100);
            $table->string('language', 100);
            $table->string('nationality', 100);
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
        Schema::dropIfExists('movie_tbl');
    }
}
