<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTokenTable extends Migration
{

    public function up()
    {
        Schema::create('user_token', function (Blueprint $table) {
            $table->string('app_id');
            $table->string('user_id');
            $table->string('user_token')->unique();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->primary(['app_id', 'user_id']);
        });
    }


    public function down()
    {
        Schema::drop('user_token');
    }
    
}
