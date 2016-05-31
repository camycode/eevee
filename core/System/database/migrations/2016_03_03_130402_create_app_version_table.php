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
            $table->string('app_version_app_id');
            $table->string('app_version_alias');
            $table->string('app_version_version');
            $table->text('app_version_description');
            $table->primary(['app_version_app_id', 'app_version_alias', 'app_version_version']);
            $table->foreign('app_version_app_id')->references('app_id')->on('app')->onDelete('cascade');
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
