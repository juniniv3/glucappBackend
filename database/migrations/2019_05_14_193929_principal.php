<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Principal extends Migration
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
          $table->string('name');
          $table->string('email')->unique();
          $table->string('password');
          $table->integer('age');
          $table->string('diabetes_type');
          $table->string('verified_mail');
      });


    Schema::create('registries', function (Blueprint $table) {
        $table->increments('id');
        $table->dateTime('date');
        $table->integer('measurement');
        $table->integer('level');
        $table->string('classification');
        $table->string('message');
        $table->string('situation');
        $table->unsignedInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users');
    });


}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
