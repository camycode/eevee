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
            $table->string('name');
            $table->mediumText('description');
            $table->primary('id');
            $table->foreign('app_id')->references('id')->on('app')->onDelete('cascade');
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
