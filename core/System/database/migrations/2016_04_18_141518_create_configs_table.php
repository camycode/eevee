<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->string('config_key');
            $table->string('config_value');
            $table->string('source');
            $table->primary('config_key');
        });
    }


    public function down()
    {
        Schema::drop('configs');
    }
}
