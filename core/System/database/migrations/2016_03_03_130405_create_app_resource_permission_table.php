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
            $table->string('app_resource_permission_id');
            $table->string('app_resource_permission_app_id');
            $table->string('app_resource_permission_resource_id');
            $table->string('app_resource_permission_name');
            $table->mediumText('app_resource_permission_description');
            $table->primary('app_resource_permission_id');
            $table->foreign('app_resource_permission_app_id')->references('app_id')->on('app')->onDelete('cascade');
            $table->foreign('app_resource_permission_resource_id')->references('resource_id')->on('resource')->onDelete('cascade');
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
