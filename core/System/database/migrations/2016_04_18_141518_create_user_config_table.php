<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserConfigTable extends Migration
{
    public function up()
    {
        Schema::create('user_config', function (Blueprint $table) {
            $table->string('user_id');
            $table->string('config_key');
            $table->longText('config_value');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->primary('user_id', 'key');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::drop('user_config');
    }
}
