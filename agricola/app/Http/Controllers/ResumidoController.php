<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Anuncio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Foto;
use App\Categoria;
use App\Classificacao;
use App\Endereco;
use PhpParser\Node\Stmt\Class_;
use Illuminate\Support\Facades\Input;
use Auth;

class ResumidoController extends Controller
{
    //
    public function index(){

		$estados = DB::table('ufs')->get();
		$classificacoes = DB::table('classificacaos')->get();
		$categorias = DB::table('categorias')->get();


		$anu = Anuncio::join('users','users.id','=','anuncios.idanunciante')->where('anuncios.situacao','=','ativo')
				->orderby('anuncios.titulo')
				->select('anuncios.id as idanuncio','users.name as name', 'anuncios.titulo as titulo', 'anuncios.id as id',
						'anuncios.descricao as descricao','anuncios.tipoanuncio as tipoanuncio','anuncios.datavalidade as validade')
				->paginate(10);

		$num = 0;
		$imagens = collect();
		foreach ($anu as $a){
			$dir = $a->id;
			$f= Storage::allFiles('Anuncios/'.$dir.'/');

			if($f != null){
				$im = $f[0];
			} else{
				$im=null;
			}


			$imagens[$num] = array(
					'imagem' => $im,
					'anuncio' => $a->id,
			);
			$num = $num+1;
		}

		//
		//dd(sizeof($imagens));
	/*	for($i=0;$i<10;$i++) {
			dd($imagens[$i]['anuncio']);
*/		//dd($anu);
    	return view('welcome', compact('anu','imagens','estados','classificacoes','categorias'));
    }

	public function filtra()
	{

		$categoria = Input::get('categoria');
		$classificacao = Input::get('classificacao');
		$titulo = Input::get('titulo');
		$estado = Input::get('estado');
		$tipo = Input::get('tipo');

		$query = Anuncio::join('enderecos', 'enderecos.id', '=', 'Anuncios.idendereco')->leftjoin('users', 'users.id', '=', 'anuncios.idanunciante')->select('anuncios.*', 'enderecos.iduf', 'users.name as name')->where('anuncios.situacao', '=', 'ativo');

		if ($titulo)
			$query->where('titulo', 'LIKE', '%' . $titulo . '%');

		if ($classificacao)
			$query->where('anuncios.tipo', '=', $classificacao);

		if ($categoria)
			$query->where('classe', '=', $categoria);

		if ($tipo)
			$query->where('tipoanuncio', '=', $tipo);

		if ($estado)
			$query->where('enderecos.iduf', '=', $estado);

		$anu = $query->orderBy('anuncios.created_at', 'desc')->where('idanunciante', '!=', Auth::user()->id)->paginate(10);

		$estados = DB::table('ufs')->get();
		$classificacoes = DB::table('classificacaos')->get();
		$categorias = DB::table('categorias')->get();


		$num = 0;
		$imagens = collect();

		foreach ($anu as $a) {
			$dir = $a->id;
			$f = Storage::allFiles('Anuncios/' . $dir . '/');

			if ($f != null) {
				$im = $f[0];
			} else {
				$im = null;
			}


			$imagens[$num] = array(
					'imagem' => $im,
					'anuncio' => $a->id,
			);
			$num = $num + 1;
		}
		return view('welcome', compact('anu','imagens','estados','classificacoes','categorias'));
	}




	}
