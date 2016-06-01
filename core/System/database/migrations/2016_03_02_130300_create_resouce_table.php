<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResouceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('resource', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->string('parent');
            $table->string('logo');
            $table->mediumText('description');
            $table->string('source');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('resource');
    }
}
