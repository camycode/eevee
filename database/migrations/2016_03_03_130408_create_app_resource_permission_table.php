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
            $table->string('resource_id');
            $table->string('permission_id');
            $table->string('resource_type');
            $table->string('resource_status');
            $table->primary('id');
            $table->unique('resource_id', 'permission_id');
            $table->foreign('resource_id')->references('id')->on('app_resource');
            $table->foreign('permission_id')->references('id')->on('resource_permission');
            $table->foreign('resource_type')->references('id')->on('app_resource_type');
            $table->foreign('resource_status')->references('id')->on('app_resource_status');
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
