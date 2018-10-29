<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id')->unsigned();
            $table->foreign('business_id')->references('id')->on('business');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('date_of_birth');
            $table->decimal('hourly_rate', 8, 2);
            $table->integer('contract_hours')->default(0);
            $table->string('address');
            $table->string('address_nr');
            $table->string('postal_code');
            $table->string('place');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
