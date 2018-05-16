<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idusuario1')->unsigned();
            $table->integer('idusuario2')->unsigned();
            $table->timestamps();
        });
        Schema::table('conversas', function($table) {
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
        Schema::dropIfExists('conversas');
    }
}
