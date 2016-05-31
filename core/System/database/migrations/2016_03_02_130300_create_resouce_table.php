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
            $table->string('resource_id');
            $table->string('resource_name');
            $table->string('resource_parent');
            $table->string('resource_logo');
            $table->mediumText('resource_description');
            $table->string('resource_source');
            $table->primary('resource_id');
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
