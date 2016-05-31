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
            $table->string('term_id');
            $table->string('term_app_id');
            $table->string('term_user_id');
            $table->string('term_name');
            $table->string('term_parent');
            $table->integer('term_status');
            $table->timestamp('term_created_at');
            $table->timestamp('term_updated_at');
            $table->primary('term_id');
            $table->foreign('term_app_id')->references('app_id')->on('app')->onDelete('restrict');
            $table->foreign('term_user_id')->references('user_id')->on('user')->onDelete('cascade');
            $table->unique(['term_app_id', 'term_name']);

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
