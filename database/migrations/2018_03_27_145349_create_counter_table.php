<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter_tbl', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admin_tbl');      
            $table->integer('counter_number');
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('designation',100);
            $table->string('username',100);
            $table->string('password',250);
            $table->string('email',100);
            $table->string('mobile',100);
            $table->enum('suspend',['Yes','No']);
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
        Schema::dropIfExists('counter_tbl');
    }
}
