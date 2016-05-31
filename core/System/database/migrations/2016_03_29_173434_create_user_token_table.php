<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTokenTable extends Migration
{

    public function up()
    {
        Schema::create('user_token', function (Blueprint $table) {
            $table->string('user_token_app_id');
            $table->string('user_token_user_id');
            $table->string('user_token_user_token')->unique();
            $table->timestamp('user_token_created_at');
            $table->timestamp('user_token_updated_at');
            $table->primary(['user_token_app_id', 'user_token_user_id']);
            $table->foreign('user_token_app_id')->references('app_id')->on('app')->onDelete('restrict');
            $table->foreign('user_token_user_id')->references('app_id')->on('user')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::drop('user_token');
    }
    
}
