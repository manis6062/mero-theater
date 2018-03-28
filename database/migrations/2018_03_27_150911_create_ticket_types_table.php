<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned();
            $table->text('description');
            $table->string('label', 100);
            $table->string('ticket_class', 100);
            $table->integer('ticket_class_id')->unsigned();
            $table->float('default_price');
            $table->integer('display_sequence');
            $table->string('voucher_identifier', 100)->nullable();
            $table->string('sales_via', 255)->nullable();
            $table->string('ticket_type', 100)->nullable();
            $table->string('slug', 255);
            $table->timestamps();
            $table->foreign('admin_id')
                ->references('id')->on('admin_tbl')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('ticket_class_id')
                ->references('id')->on('ticket_classes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_types');
    }
}
