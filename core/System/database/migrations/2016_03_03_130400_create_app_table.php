<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppTable extends Migration
{
    public function up()
    {
        Schema::create('app', function (Blueprint $table) {
            $table->string('app_id');
            $table->string('app_name')->unique();
            $table->string('app_parent');
            $table->text('app_description');
            $table->integer('app_status');
            $table->timestamp('app_created_at');
            $table->timestamp('app_updated_at');
            $table->primary('app_id');
        });
    }


    public function down()
    {
        Schema::drop('app');
    }
}
