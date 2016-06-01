<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppClientTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('app_client', function (Blueprint $table) {
            $table->string('id');
            $table->string('app_id');
            $table->primary(['id','app_id']);
            $table->foreign('app_id')->references('id')->on('app')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('app_client');
    }
}
