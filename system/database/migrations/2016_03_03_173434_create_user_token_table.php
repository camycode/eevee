<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTokenTable extends Migration
{

    public function up()
    {
        Schema::create('user_token', function (Blueprint $table) {
            $table->string('user_id');
            $table->string('user_token')->unique();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::drop('user_token');
    }
    
}
