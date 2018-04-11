<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Emailcampaign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('emailcampaign_tbl', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('theater_id')->unsigned();
            $table->foreign('theater_id')->references('id')->on('admin_tbl');
            $table->string('name',100);
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
       Schema::dropIfExists('emailcampaign_tbl');
    }
}
