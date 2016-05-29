<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemConfigsTable extends Migration
{
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->string('config_key');
            $table->string('config_value');
            $table->string('source');
            $table->timestamps();
            $table->primary('config_key');
        });
    }


    public function down()
    {
        Schema::drop('config');
    }
}
