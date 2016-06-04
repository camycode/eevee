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
            $table->string('client_id');
            $table->string('version');
            $table->text('description');
            $table->string('status');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->primary(['client_id', 'version']);
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
