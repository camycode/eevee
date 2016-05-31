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
            $table->string('app_message_id');
            $table->string('app_message_app_id');
            $table->string('app_message_message');
            $table->integer('app_message_status');
            $table->timestamp('app_message_created_at');
            $table->timestamp('app_message__at');
            $table->primary('app_message_id');
            $table->foreign('app_message_app_id')->references('app_id')->on('app')->onDelete('cascade');
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
