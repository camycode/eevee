<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppStatusTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('app_status', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->text('description');
            $table->primary('id');
            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('app_status');
    }
}
