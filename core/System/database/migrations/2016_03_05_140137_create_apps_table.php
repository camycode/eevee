<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppsTable extends Migration
{
    public function up()
    {
        Schema::create('app', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->text('description');
            $table->string('status');
            $table->timestamps();
            $table->primary('id');
        });
    }


    public function down()
    {
        Schema::drop('app');
    }
}
