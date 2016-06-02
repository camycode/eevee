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
            $table->string('app_resource_id');
            $table->string('permission_id');
            $table->string('app_resource_type');
            $table->primary('id');
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
