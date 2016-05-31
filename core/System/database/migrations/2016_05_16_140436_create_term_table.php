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
            $table->string('parent');
            $table->integer('status');
            $table->timestamps();
            $table->primary('id');
            $table->foreign('app_id')->references('id')->on('app')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
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
