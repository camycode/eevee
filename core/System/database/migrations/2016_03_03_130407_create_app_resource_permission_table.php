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
            $table->string('name');
            $table->text('description');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->primary('id');
            $table->unique(['resource_id', 'name']);
            $table->foreign('permission_id')->references('id')->on('resource_permission');
            $table->foreign(['resource_type', 'resource_id'])->references(['id', 'resource_id'])->on('app_resource_type');
            $table->foreign(['resource_status', 'resource_id'])->references(['id', 'resource_id'])->on('app_resource_status');

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
