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
            $table->string('email', 255)->unique();
            $table->string('password', 100);
            $table->string('role');
            $table->string('avatar');
            $table->string('status');
            $table->string('app_id');
            $table->timestamps();
            $table->primary('id');
            $table->foreign('app_id')->references('id')->on('app')->onDelete('cascade');
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
