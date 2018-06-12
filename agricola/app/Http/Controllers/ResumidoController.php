<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Anuncio;
use Illuminate\Support\Facades\DB;

class ResumidoController extends Controller
{
    //
    public function index(){
		$anu = Anuncio::join('users','users.id','=','anuncios.idanunciante')->where('anuncios.situacao','=','ativo')->orderby('anuncios.titulo')->select('anuncios.id as idanuncio','users.name as name', 'anuncios.titulo as titulo', 'anuncios.id as id', 'anuncios.descricao as descricao','anuncios.tipoanuncio as tipoanuncio','anuncios.datavalidade as validade')->
		paginate(30);

    	return view('welcome')->with('anu',$anu);
    }	
}
