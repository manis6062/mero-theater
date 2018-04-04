<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Emailgroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {         
       Schema::create('emailgroup_tbl', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('admin_id');
           $table->string('name');
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
        Schema::dropIfExists('emailcontacts_tbl');
    }
}
