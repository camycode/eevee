<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppResourceStatusTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('app_resource_status', function (Blueprint $table) {
            $table->string('id');
            $table->string('resource_id');
            $table->string('name');
            $table->text('description');
            $table->primary('id');
            $table->unique('name');
            $table->foreign('resource_id')->references('id')->on('app_resource');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('app_resource_status');
    }
}
