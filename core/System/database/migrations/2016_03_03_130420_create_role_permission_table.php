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
            $table->string('role_permission_role_id');
            $table->string('role_permission_permission_id');
            $table->primary(['role_permission_role_id', 'role_permission_permission_id']);
            $table->foreign('role_permission_role_id')->references('role_id')->on('role')->onDelete('restrict');
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
