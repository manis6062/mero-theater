<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentapiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_api', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('payment_type_id')->unsigned();
             $table->foreign('payment_type_id')->on('payment_tbl')->references('id');
              $table->string('label');
               $table->string('api_key');
                $table->string('api_type');
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
        Schema::dropIfExists('payment_api');
    }
}
