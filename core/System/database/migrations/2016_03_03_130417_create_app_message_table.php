<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_message', function (Blueprint $table) {
            $table->string('id');
            $table->string('app_id');
            $table->string('message');
            $table->integer('status');
            $table->timestamps();
            $table->primary('id');
            $table->foreign('app_id')->references('id')->on('app');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('app_message');
    }

}
