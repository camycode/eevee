<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResource extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('resource', function (Blueprint $table) {
            $table->string('id');
            $table->string('app_id');
            $table->string('name');
            $table->text('description');
            $table->text('attribute');
            $table->string('type');
            $table->string('parent');
            $table->string('icon');
            $table->string('source');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->primary(['id','app_id']);

            $table->unique(['app_id', 'name']);

            $table->foreign('app_id')->references('id')->on('app');
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
