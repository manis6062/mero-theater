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
              $table->string('gateway_id');
               $table->string('contact_person');
                $table->string('phone');
                 $table->string('image');
                  $table->text('description');
                   $table->string('link');
                    $table->string('status');
                     $table->text('live_note');
                      $table->text('test_note');
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
