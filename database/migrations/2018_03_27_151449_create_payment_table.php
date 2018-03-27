<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_tbl', function (Blueprint $table) {
            $table->increments('id');
             $table->string('name');
              $table->string('gateway_id')->nullable();
               $table->string('contact_person')->nullable();
                $table->string('phone')->nullable();
                 $table->string('image');
                  $table->text('description')->nullable();
                   $table->string('link')->nullable();
                    $table->string('status');
                     $table->text('live_note')->nullable();
                      $table->text('test_note')->nullable();
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
        Schema::dropIfExists('payment_tbl');
    }
}
