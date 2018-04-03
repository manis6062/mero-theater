<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Forgotpassword extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forgotpassword_tbl', function (Blueprint $table) {
            $table->increments('id');
             $table->unsignedInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admin_tbl');
            $table->string('token',250);
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
        Schema::dropIfExists('forgotpassword_tbl');
    }
}
