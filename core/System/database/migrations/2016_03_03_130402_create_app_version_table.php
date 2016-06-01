<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_version', function (Blueprint $table) {
            $table->string('app_id');
            $table->string('device');
            $table->string('version');
            $table->text('description');
            $table->primary(['app_id', 'device', 'version']);
            $table->foreign('app_id')->references('id')->on('app')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('app_version');
    }
}
