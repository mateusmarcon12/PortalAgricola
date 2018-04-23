<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasaofertademandasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casaofertademandas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idoferta')->unsigned();
            $table->integer('iddemanda')->unsigned();
            $table->integer('idinteressado')->unsigned();
            $table->float('graucompatibilidade');
            $table->timestamps();
        });

        Schema::table('casaofertademandas', function($table) {
            $table->foreign('idoferta')->references('id')->on('anuncios');
            $table->foreign('iddemanda')->references('id')->on('anuncios');
            $table->foreign('idinteressado')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casaofertademandas');
    }
}
