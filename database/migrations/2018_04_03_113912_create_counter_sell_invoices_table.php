<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounterSellInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter_sell_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('counter_id')->unsigned();
            $table->string('invoice_number');
            $table->string('customer_name')->nullable();
            $table->string('customer_pan_num')->nullable();;
            $table->float('gross_total');
            $table->string('payment_mode');
            $table->timestamps();
            $table->foreign('counter_id')
                ->references('id')->on('counter_tbl')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counter_sell_invoices');
    }
}
