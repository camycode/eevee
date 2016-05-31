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
            $table->string('app_resource_id');
            $table->string('app_resource_app_id');
            $table->string('app_resource_name');
            $table->mediumText('app_resource_description');
            $table->primary('app_resource_id');
            $table->foreign('app_resource_app_id')->references('app_id')->on('app')->onDelete('cascade');
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
