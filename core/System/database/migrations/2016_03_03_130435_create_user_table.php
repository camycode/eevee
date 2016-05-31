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
            $table->string('app_id');
            $table->string('role_id');
            $table->string('username');
            $table->string('email', 255);
            $table->string('password', 100);
            $table->string('role');
            $table->string('avatar');
            $table->string('source');
            $table->integer('status');
            $table->timestamps();
            $table->primary('id');
            $table->foreign('app_id')->references('id')->on('app')->onDelete('restrict');
            $table->foreign('role_id')->references('id')->on('role')->onDelete('restrict');
            $table->unique(['app_id', 'email']);
            $table->unique(['app_id', 'username']);
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
