<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id');
            $table->integer('message_id')->unsigned();
            $table->text('body');
            $table->string('recipient');
            $table->enum('status', ['pending', 'failed', 'delivered']);
            $table->string('network');
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
        Schema::dropIfExists('message_history');
    }
}
