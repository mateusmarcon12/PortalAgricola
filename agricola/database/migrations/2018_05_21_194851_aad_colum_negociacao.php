<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AadColumNegociacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('negociacaos', function (Blueprint $table) {
           
            $table->integer('idusuario1')->unsigned();
            $table->integer('idusuario2')->unsigned();

        });
        Schema::table('negociacaos', function($table) {
            $table->foreign('idusuario1')->references('id')->on('users');
            $table->foreign('idusuario2')->references('id')->on('users');
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
