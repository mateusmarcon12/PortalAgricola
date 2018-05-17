<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegociacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negociacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idanuncio1')->unsigned();
            $table->integer('idanuncio2')->unsigned()->nullable();
            $table->string('resultado')->nullable();
            $table->string('situacao');
            $table->timestamps();
        });
        Schema::table('negociacaos', function($table) {
            $table->foreign('idanuncio1')->references('id')->on('anuncios');
            $table->foreign('idanuncio2')->references('id')->on('anuncios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negociacaos');
    }
}
