<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AadColumMensagens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('mensagens', function (Blueprint $table) {
            //
            $table->integer('idconversa')->unsigned();
        });
        Schema::table('mensagens', function($table) {
            $table->foreign('idconversa')->references('id')->on('conversas');
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
