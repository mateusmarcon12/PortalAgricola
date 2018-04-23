<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idanunciante')->unsigned();
            $table->string('titulo');
            $table->integer('classe')->nullable();
            $table->date('datavalidade')->nullable();
            $table->string('situacao');
            $table->longText('descricao')->nullable();
            $table->string('tipo')->nullable();
            $table->string('fotos')->nullable();
            $table->longText('observacao')->nullable();
            $table->timestamps();
        });

        Schema::table('ofertas', function($table) {
            $table->foreign('idanunciante')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ofertas');
    }
}
