<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->string('post_id');
            $table->string('post_app_id');
            $table->string('post_user_id');
            $table->string('post_term_id');
            $table->string('post_title');
            $table->text('post_content');
            $table->string('post_type');
            $table->integer('post_status');
            $table->timestamp('post_created_at');
            $table->timestamp('post_updated_at');
            $table->primary('post_id');
            $table->foreign('post_app_id')->references('app_id')->on('app')->onDelete('restrict');
            $table->foreign('post_user_id')->references('user_id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post');
    }
}
