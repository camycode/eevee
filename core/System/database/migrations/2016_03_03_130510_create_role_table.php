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
            $table->string('id');
            $table->string('app_id');
            $table->string('name');
            $table->mediumText('description');
            $table->string('parent');
            $table->integer('permission_amount');
            $table->integer('status');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->primary(['id','app_id']);

            $table->unique(['app_id', 'name']);

            $table->foreign('app_id')->references('id')->on('app');
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
