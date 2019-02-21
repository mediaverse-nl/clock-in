<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('location_id')->nullable()->unsigned();
            $table->foreign('location_id')->references('id')->on('location');
            $table->string('title')->nullable();
            $table->string('description', 200)->nullable();
            $table->boolean('full_day')->default(0);
            $table->string('status')->default('standaard');
            $table->timestamp('start');
            $table->timestamp('stop')->nullable();
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
        Schema::dropIfExists('calendar');
    }
}
