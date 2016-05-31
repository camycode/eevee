<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->string('role_id');
            $table->string('role_app_id');
            $table->string('role_name');
            $table->mediumText('role_description');
            $table->string('role_parent');
            $table->integer('role_permission_amount');
            $table->integer('role_status');
            $table->timestamp('role_created_at');
            $table->timestamp('role_updated_at');
            $table->primary('role_id');
            $table->foreign('role_app_id')->references('app_id')->on('app')->onDelete('restrict');
            $table->unique(['role_app_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role');
    }
}
