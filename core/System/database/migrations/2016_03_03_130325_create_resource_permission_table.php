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
            $table->string('id');
            $table->string('resource_id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();

            $table->primary('id');
            $table->unique('name');
            $table->foreign('resource_id')->references('id')->on('resource');
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
