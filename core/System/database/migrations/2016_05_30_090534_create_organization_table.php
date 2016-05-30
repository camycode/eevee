<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization', function (Blueprint $table) {
            $table->string('id');
            $table->string('root');
            $table->string('name')->unique();
            $table->mediumText('description');
            $table->string('parent');
            $table->string('status');
            $table->timestamps();
            $table->primary('id');
            $table->foreign('root')->references('id')->on('role')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('organization');
    }
}
