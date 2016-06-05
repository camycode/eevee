<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permission', function (Blueprint $table) {
            $table->string('app_id');
            $table->string('role_id');
            $table->string('permission_id');

            $table->primary(['app_id', 'role_id', 'permission_id']);

            $table->foreign(['role_id', 'app_id'])->references(['id', 'app_id'])->on('role');

            $table->foreign(['permission_id', 'app_id'], 'app_role_permission')->references(['id', 'app_id'])->on('permission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_permission');
    }

}
