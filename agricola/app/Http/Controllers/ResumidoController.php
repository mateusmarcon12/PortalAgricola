<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Anuncio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Foto;
use PhpParser\Node\Stmt\Class_;

class ResumidoController extends Controller
{
    //
    public function index(){
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
    	return view('welcome', compact('anu','imagens'));
    }	
}
