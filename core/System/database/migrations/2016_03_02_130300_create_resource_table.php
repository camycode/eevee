<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('resource', function (Blueprint $table) {
            $table->string('id');
            $table->string('name')->unique();
            $table->string('parent');
            $table->string('icon');
            $table->mediumText('description');
            $table->string('source');
            $table->timestamps();
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
