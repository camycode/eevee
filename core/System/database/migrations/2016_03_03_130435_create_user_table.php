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
            $table->string('user_id');
            $table->string('user_app_id');
            $table->string('user_role_id');
            $table->string('user_username');
            $table->string('user_email', 255);
            $table->string('user_password', 100);
            $table->string('user_role');
            $table->string('user_avatar');
            $table->string('user_source');
            $table->integer('user_status');
            $table->timestamp('user_created_at');
            $table->timestamp('user_updated_at');
            $table->primary('user_id');
            $table->foreign('user_app_id')->references('app_id')->on('app')->onDelete('restrict');
            $table->foreign('user_role_id')->references('role_id')->on('role')->onDelete('restrict');
            $table->unique(['user_app_id', 'email']);
            $table->unique(['user_app_id', 'username']);
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
