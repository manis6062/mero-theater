<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->on('user_tbl')->references('id');
             $table->string('amount');
              $table->string('fee');
               $table->integer('payment_type_id')->unsigned();
                $table->foreign('payment_type_id')->on('payment_tbl')->references('id');
                 $table->string('transaction_type');
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
        Schema::dropIfExists('transaction_log');
    }
}
