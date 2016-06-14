<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_version', function (Blueprint $table) {
            $table->string('client_id');
            $table->string('version');
            $table->text('description');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->primary(['client_id', 'version']);
            $table->foreign('client_id')->references('id')->on('client');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('client_version');
    }
}
