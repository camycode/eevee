<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppTable extends Migration
{
    public function up()
    {
        Schema::create('app', function (Blueprint $table) {
            $table->string('id');
            $table->string('name')->unique();
            $table->text('description');
            $table->integer('status');
            $table->timestamps();
            $table->primary('id');
        });
    }


    public function down()
    {
        Schema::drop('app');
    }
}
