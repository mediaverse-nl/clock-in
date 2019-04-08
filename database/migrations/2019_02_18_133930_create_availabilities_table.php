<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->time('start_monday')->nullable();
            $table->time('start_tuesday')->nullable();
            $table->time('start_wednesday')->nullable();
            $table->time('start_thursday')->nullable();
            $table->time('start_friday')->nullable();
            $table->time('start_saturday')->nullable();
            $table->time('start_sunday')->nullable();
            $table->time('end_monday')->nullable();
            $table->time('end_tuesday')->nullable();
            $table->time('end_wednesday')->nullable();
            $table->time('end_thursday')->nullable();
            $table->time('end_friday')->nullable();
            $table->time('end_saturday')->nullable();
            $table->time('end_sunday')->nullable();
            $table->integer('week_nr');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('availabilities');
    }
}
