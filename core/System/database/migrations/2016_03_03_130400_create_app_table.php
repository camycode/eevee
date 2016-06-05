<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppTable extends Migration
{
    public function up()
    {
        Schema::create('app', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->string('parent');
            $table->text('description');
            $table->integer('status');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            
            $table->primary('id');
            $table->unique('name');
        });
    }


    public function down()
    {
        Schema::drop('app');
    }
}
