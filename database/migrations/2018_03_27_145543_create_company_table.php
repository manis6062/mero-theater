<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admin_tbl');
            $table->string('company_name',100);
            $table->string('vat_number',100);
            $table->string('company_display_name',100);
            $table->string('country',100);
            $table->string('timezone',100);
            $table->string('address1',100);
            $table->string('address2',100);
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
        Schema::dropIfExists('company_tbl');
    }
}
