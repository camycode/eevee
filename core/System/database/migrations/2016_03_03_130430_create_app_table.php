<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppTable extends Migration
{
    public function up()
    {
        Schema::create('app', function (Blueprint $table) {
            $table->string('id');
            $table->string('version');
            $table->string('name')->unique();
            $table->text('description');
            $table->string('status');
            $table->timestamps();
            $table->primary(['id', 'version']);
        });
    }


    public function down()
    {
        Schema::drop('app');
    }
}
