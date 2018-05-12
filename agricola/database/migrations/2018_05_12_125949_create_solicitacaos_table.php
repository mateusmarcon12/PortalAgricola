<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idsolicitante')->unsigned();
            $table->integer('idsolicitado')->unsigned();
            $table->timestamps();
        });
        Schema::table('solicitacaos', function($table) {
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
        Schema::dropIfExists('solicitacaos');
    }
}
