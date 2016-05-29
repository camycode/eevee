<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTokensTable extends Migration
{

    public function up()
    {
        Schema::create('user_token', function (Blueprint $table) {
            $table->string('app_id');
            $table->string('user_id');
            $table->string('user_token')->unique();
            $table->timestamps();
            $table->primary(['app_id', 'user_id']);
            $table->foreign('app_id')->references('id')->on('app')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::drop('user_token');
    }
    
}
