<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmizadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amizades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idsolicitante')->unsigned();
            $table->integer('idsolicitado')->unsigned();
            $table->timestamps();
        });

        Schema::table('amizades', function($table) {
            $table->foreign('idsolicitante')->references('id')->on('users');
            $table->foreign('idsolicitado')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amizades');
    }
}
