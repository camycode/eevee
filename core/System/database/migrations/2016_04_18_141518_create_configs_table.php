<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->string('user_id');
            $table->string('config_key');
            $table->longText('config_value');
            $table->string('source');
            $table->timestamps();
            $table->primary('user_id', 'config_key');
        });
    }


    public function down()
    {
        Schema::drop('config');
    }
}
