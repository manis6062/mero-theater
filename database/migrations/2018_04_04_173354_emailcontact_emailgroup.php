<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmailcontactEmailgroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emailcontact_emailgroup_tbl', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('emailcontact_id');
            $table->foreign('emailcontact_id')->references('id')->on('emailcontacts_tbl');
            $table->unsignedInteger('emailgroup_id');
            $table->foreign('emailgroup_id')->references('id')->on('emailgroup_tbl');
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
         Schema::dropIfExists('emailcontact_emailgroup_tbl');
    }
}
