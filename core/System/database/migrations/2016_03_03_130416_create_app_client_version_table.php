<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppClientVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_client_version', function (Blueprint $table) {
            $table->string('app_id');
            $table->string('client_id');
            $table->string('version');
            $table->text('description');
            $table->primary(['app_id', 'client_id', 'version']);
            $table->foreign('app_id')->references('id')->on('app');
            $table->foreign('client_id')->references('id')->on('app_client');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('app_client_version');
    }
}
