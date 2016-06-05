<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientVersionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('client_version', function (Blueprint $table) {
            $table->string('app_id');
            $table->string('client_id');
            $table->string('version');
            $table->text('description');
            $table->string('status');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->primary(['app_id', 'client_id', 'version']);

            $table->foreign(['app_id', 'client_id'])->references(['app_id', 'id'])->on('client');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('client_version');
    }
}
