<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppConfigTable extends Migration
{
    public function up()
    {
        Schema::create('app_config', function (Blueprint $table) {
            $table->string('app_id');
            $table->string('config_key');
            $table->string('config_value');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->primary(['app_id', 'config_key']);
        });
    }


    public function down()
    {
        Schema::drop('app_config');
    }
}
