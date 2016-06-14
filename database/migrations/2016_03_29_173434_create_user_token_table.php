<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTokenTable extends Migration
{

    public function up()
    {
        Schema::create('user_token', function (Blueprint $table) {
            $table->string('client_id');
            $table->string('user_id');
            $table->string('user_token');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->primary(['client_id', 'user_id']);
            $table->unique('user_token');
            $table->foreign('client_id')->references('id')->on('client');
            $table->foreign('user_id')->references('id')->on('user');
        });
    }


    public function down()
    {
        Schema::drop('user_token');
    }

}
