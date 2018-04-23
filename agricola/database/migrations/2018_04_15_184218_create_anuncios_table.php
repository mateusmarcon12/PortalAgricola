<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnunciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('anuncios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idanunciante')->unsigned();
            $table->integer('idendereco')->unsigned();
            $table->string('titulo');
            $table->string('tipoanuncio');
            $table->string('quantidade');
            $table->string('unidademedida');
            $table->integer('classe')->nullable();
            $table->date('datavalidade')->nullable();
            $table->string('situacao');
            $table->longText('descricao')->nullable();
            $table->string('tipo')->nullable();
            $table->string('fotos')->nullable();
            $table->longText('observacao')->nullable();
            $table->timestamps();
        });

        Schema::table('anuncios', function($table) {
            $table->foreign('idanunciante')->references('id')->on('users');
            $table->foreign('idendereco')->references('id')->on('enderecos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anuncios');
    }
}
