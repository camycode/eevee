<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppResource extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('app_resource', function (Blueprint $table) {
            $table->string('id');
            $table->string('app_id');
            $table->string('resource_id');
            $table->string('name');
            $table->text('description');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            
            $table->primary('id');
            $table->unique(['app_id', 'name']);
            $table->foreign('app_id')->references('id')->on('app');
            $table->foreign('resource_id')->references('id')->on('resource');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('app_resource');
    }
}
