<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppResourcePermissionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('app_resource_permission', function (Blueprint $table) {
            $table->string('id');
            $table->string('app_id');
            $table->string('resource_id');
            $table->string('name');
            $table->mediumText('description');
            $table->primary('id');
            $table->foreign('app_id')->references('id')->on('app')->onDelete('cascade');
            $table->foreign('resource_id')->references('id')->on('resource')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('app_resource_permission');
    }
}
