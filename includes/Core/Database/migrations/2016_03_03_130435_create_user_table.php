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
            $table->string('username')->unique();
            $table->string('email', 255);
            $table->string('phone', 255);
            $table->string('password', 100);
            $table->string('nickname');
            $table->string('avatar');
            $table->string('source');
            $table->string('status');
            $table->timestamps();
            $table->primary('id');
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
