<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->string('description');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('client');
    }
}
