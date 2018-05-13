<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecomendacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recomendacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idrecomendante')->unsigned();
            $table->integer('idrecomendado')->unsigned();
            $table->integer('idanuncio')->unsigned();
            $table->timestamps();
        });
        Schema::table('recomendacaos', function($table) {
            $table->foreign('idrecomendante')->references('id')->on('users');
            $table->foreign('idrecomendado')->references('id')->on('users');
            $table->foreign('idanuncio')->references('id')->on('anuncios');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recomendacaos');
    }
}
