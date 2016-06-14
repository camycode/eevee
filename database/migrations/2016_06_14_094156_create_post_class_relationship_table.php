<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostClassRelationshipTable extends Migration
{
    public function up()
    {
        Schema::create('post_class_relationship', function (Blueprint $table) {
            $table->string('post_id');
            $table->string('post_class_id');
            $table->primary(['post_id', 'post_class_id']);
            $table->foreign('post_id')->references('id')->on('post');
            $table->foreign('post_class_id')->references('id')->on('post_class');
        });
    }


    public function down()
    {
        Schema::drop('post_class_relationship');
    }
}
