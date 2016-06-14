<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_class', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->text('description');
            $table->string('status');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
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
        Schema::drop('post_class');
    }
}
