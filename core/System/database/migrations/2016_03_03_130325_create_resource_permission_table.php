<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcePermissionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('resource_permission', function (Blueprint $table) {
            $table->string('resource_permission_id');
            $table->string('resource_permission_resource_id');
            $table->string('resource_permission_name');
            $table->mediumText('resource_permission_description');
            $table->primary('resource_permission_id');
            $table->foreign('resource_permission_resource_id')->references('resource_id')->on('resource')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('resource_permission');
    }
}
