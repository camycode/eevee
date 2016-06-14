<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->string('id');
            $table->string('username');
            $table->string('email', 255);
            $table->string('password', 100);
            $table->string('avatar');
            $table->string('source');
            $table->string('status');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->primary('id');
            $table->unique('email');
            $table->unique('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('user');
    }
}
