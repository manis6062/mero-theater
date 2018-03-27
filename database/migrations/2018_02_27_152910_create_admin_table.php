<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_tbl', function (Blueprint $table) {   
            $table->increments('id');
            $table->string('account_name',100);
            $table->string('title',100);
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('mobile',100);
            $table->string('username',100);
            $table->string('email',100);
            $table->string('password',250);
            $table->string('last_login_time',100)->nullable();
            $table->string('remember_token',100)->nullable();
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
        Schema::dropIfExists('admin_tbl');
    }
}
