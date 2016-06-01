<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppPermissionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('app_permission', function (Blueprint $table) {
            $table->string('app_id');
            $table->string('permission_id');
            $table->primary(['app_id','permission_id']);
            $table->foreign('app_id')->references('id')->on('app')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permission')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('app_permission');
    }
}
