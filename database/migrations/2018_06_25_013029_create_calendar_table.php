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
            $table->string('title')->nullable();
            $table->string('description', 200)->nullable();
            $table->boolean('full_day')->default(0);
            $table->boolean('private')->default(1);
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
