<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserConfigTable extends Migration
{
    public function up()
    {
        Schema::create('user_config', function (Blueprint $table) {
            $table->string('user_config_user_id');
            $table->string('user_config_key');
            $table->longText('user_config_value');
            $table->timestamp('user_config_created_at');
            $table->timestamp('user_config_updated_at');
            $table->primary('user_config_user_id', 'user_config_key');
            $table->foreign('user_config_user_id')->references('user_id')->on('user')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::drop('user_config');
    }
}
