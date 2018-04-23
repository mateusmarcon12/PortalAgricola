<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idclassificacao')->unsigned();
            $table->integer('idpai')->nullable();
            $table->string('nome');
            $table->string('unidademedida');
            $table->timestamps();
        });

        Schema::table('categorias', function($table) {
            $table->foreign('idclassificacao')->references('id')->on('classificacaos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
