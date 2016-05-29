<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->string('id');
            $table->string('user_id');
            $table->string('title');
            $table->mediumText('content');
            $table->string('status');
            $table->string('type');
            $table->string('source');
            $table->string('sender');
            $table->timestamp('created_at');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('message');
    }
}
