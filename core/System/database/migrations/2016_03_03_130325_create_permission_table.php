<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->string('id');
            $table->string('resource_id');
            $table->string('name')->unique();
            $table->text('description');
            $table->timestamps();
            $table->primary('id');
            $table->foreign('resource_id')->references('id')->on('resource')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('permission');
    }
}
