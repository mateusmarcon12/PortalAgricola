<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('avaliacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nota');
            $table->string('comentario')->nullable();
            $table->integer('idavaliador')->unsigned();
            $table->integer('idavaliado')->unsigned();
            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avaliacaos');
    }
}
