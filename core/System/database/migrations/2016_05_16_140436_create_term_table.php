<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term', function (Blueprint $table) {
            $table->string('id');
            $table->string('app_id');
            $table->string('user_id');
            $table->string('name');
            $table->mediumText('description');
            $table->string('parent');
            $table->integer('status');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->primary('id');
            $table->unique(['app_id', 'name']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('term');
    }
}
