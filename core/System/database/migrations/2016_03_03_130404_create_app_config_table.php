<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppConfigTable extends Migration
{
    public function up()
    {
        Schema::create('app_config', function (Blueprint $table) {
            $table->string('app_config_app_id');
            $table->string('app_config_key');
            $table->string('app_config_value');
            $table->timestamp('app_config_created_at');
            $table->timestamp('app_config_updated_at');
            $table->primary(['app_config_app_id', 'app_config_key']);
        });
    }


    public function down()
    {
        Schema::drop('app_config');
    }
}
