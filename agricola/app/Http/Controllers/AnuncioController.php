<?php

namespace App\Http\Controllers;

use App\Anuncio;
use Illuminate\Http\Request;
use App\Oferta;
use App\Categoria;
use App\Classificacao;
use App\Endereco;
use App\Cidade;
use App\Pais;
use App\Uf;
use App\User;
use App\Casaofertademanda;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Amizades;
use App\Recomendacao;
use Illuminate\Support\Facades\Input;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    }

    public function index()
    {
        //

        $anu = Anuncio::where('idanunciante','=', Auth::user()->id)->paginate(10);
        $estados = DB::table('ufs')->get();
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();
      //  return view('anuncios.home')->with('anu', $anu);




        return view('anuncios.home',compact('anu','estados','classificacoes','categorias'));

    }


    //exibir todos os anúncios ativos de outros usuários
    public function todosanuncios(){

        $anu = Anuncio::join('users','users.id','=','anuncios.idanunciante')
            ->where('idanunciante','!=', Auth::user()->id)->where('anuncios.situacao','=','ativo')
            ->orderby('anuncios.created_at','desc')->select('anuncios.id as idanuncio','users.name as name', 'anuncios.titulo as titulo', 'anuncios.id as id',
                'anuncios.descricao as descricao','anuncios.tipoanuncio as tipoanuncio','anuncios.datavalidade as datavalidade')
            ->paginate(10);

         $estados = DB::table('ufs')->get();
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();
       //dd($anu);


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
        //$imagens = Anuncio::imagem($anu);

        return view('anuncios.todos',compact('anu','estados','classificacoes','categorias','imagens'));
    }

    public function listardemandas(){
        $estados = DB::table('ufs')->get();
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();
        $anu = Anuncio::join('users','users.id','=','anuncios.idanunciante')->where('idanunciante','!=', Auth::user()->id)->where('anuncios.situacao','=','ativo')->tipodemanda()->orderby('anuncios.created_at','desc')->get();
        
        return view('anuncios.todos',compact('anu','estados','classificacoes','categorias'));
        //return view('anuncios.todos')->with('anu', $anu);
    }
   
       public function listarofertas(){

        $estados = DB::table('ufs')->get();
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();
        $anu = Anuncio::join('users','users.id','=','anuncios.idanunciante')->where('idanunciante','!=', Auth::user()->id)->where('anuncios.situacao','=','ativo')->tipooferta()->orderby('anuncios.created_at','desc')->get();
        
        return view('anuncios.todos',compact('anu','estados','classificacoes','categorias'));
    }


    //Filtrar anuncios

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recomendados(){
        $recomendacoes = Recomendacao::join('anuncios','anuncios.id','=','recomendacaos.idanuncio')
            ->join('users as recidanunciante','recidanunciante.id','=','anuncios.idanunciante')
            ->join('users as recidanunciado','recidanunciado.id','=','recomendacaos.idrecomendante')
            ->where('recomendacaos.idrecomendado','=',Auth::user()->id)
            ->where('anuncios.situacao','=','ativo')
            ->select('anuncios.titulo as titulo','recidanunciante.name as nome',
                'recidanunciado.name as recomendante',
                'recidanunciante.email as anuemail',
                'recomendacaos.idanuncio as idanuncio',
                'anuncios.datavalidade as datavalidade',
                'recomendacaos.id as idrecomendacao')->
            orderby('recomendacaos.created_at','desc')
            ->paginate(25);
        $tamanho = count($recomendacoes);
        $rep =0;

        return view('anuncios.recomendados',compact('recomendacoes'));

    }
    public function create()
    {
        //
        $result = DB::table('cidades')->get();
        $estados = DB::table('ufs')->get();
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();
        $tipoanuncio='oferta.store';

        //return view('ofertas.cadastrar')->with('data', $result);
        return view('anuncios.cadastrar', compact('result','estados','classificacoes','categorias','tipoanuncio'));
    }

  //  public function filtra(Request $request)
    public function filtra()
    {

        $categoria = Input::get('categoria');
        $classificacao = Input::get('classificacao');
        $titulo = Input::get('titulo');
        $estado = Input::get('estado');
        $tipo = Input::get('tipo');

        $query = Anuncio::join('enderecos','enderecos.id','=','Anuncios.idendereco')
        ->leftjoin('users','users.id','=','anuncios.idanunciante')
        ->select('anuncios.*','enderecos.iduf','users.name as name')
        ->where('anuncios.situacao','=','ativo');

        if($titulo)
            $query->where('titulo', 'LIKE', '%' . $titulo . '%');

        if($classificacao)
            $query->where('anuncios.tipo', '=', $classificacao);

        if($categoria)
            $query->where('classe', '=', $categoria);

        if($tipo)
            $query->where('tipoanuncio', '=', $tipo);

        if($estado)
            $query->where('enderecos.iduf', '=', $estado);

        $anu = $query->orderBy('anuncios.created_at', 'desc')->where('idanunciante','!=', Auth::user()->id)->paginate(10);

        $estados = DB::table('ufs')->get();
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();


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


        //return View::make('site/libraries/list', compact('posts', 'search'));
        return view('anuncios.todos',compact('anu','estados','classificacoes','categorias','imagens'));

    }




    public function filtrarmeus(Request $request)
    {

        $categoria = $request->categoria;
        $classificacao = $request->classificacao;
        $titulo = $request->titulo;
        $situacao = $request->situacao;
        $tipo = $request->tipo;


        $query = Anuncio::join('enderecos','enderecos.id','=','Anuncios.idendereco')->leftjoin('users','users.id','=','anuncios.idanunciante')->select('anuncios.*','enderecos.iduf','users.name as name');

        if($titulo)
            $query->where('titulo', 'LIKE', '%' . $titulo . '%');

        if($classificacao)
            $query->where('anuncios.tipo', '=', $classificacao);

        if($categoria)
            $query->where('classe', '=', $categoria);

        if($tipo)
            $query->where('tipoanuncio', '=', $tipo);

        if($situacao)
            $query->where('anuncios.situacao', '=', $situacao);

        $anu = $query->orderBy('anuncios.created_at', 'desc')->where('idanunciante','=', Auth::user()->id)->paginate(25);

        $estados = DB::table('ufs')->get();
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();

        return view('anuncios.home',compact('anu','estados','classificacoes','categorias'));

    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function show(Anuncio $anuncio)
    {

        $anu = Anuncio::FindorFail($anuncio->id);
        $dir = $anu->id;
        $categoria = Categoria::Findorfail($anu->classe);
        $classificacao = Classificacao::Findorfail($anu->tipo);
        $files = Storage::allFiles('Anuncios/'.$dir.'/');

        $idanunciante = $anu->idanunciante;
        $ende = Endereco::where('id','=',$anuncio->idendereco)->join('cidades','cidades.cidade_codigo', '=','enderecos.idcidade')->join('ufs','ufs.uf_codigo', '=','enderecos.iduf')->join('paises','paises.numcode', '=','enderecos.idpais')
        ->select('enderecos.*','cidades.cidade_descricao','ufs.uf_descricao','paises.nome')
        ->get();
        $user = User::FindorFail($anuncio->idanunciante);
       //dd($ende);
        if($idanunciante == Auth::user()->id){
           Return view('anuncios.exibe',compact('anu','files','ende','user','categoria','classificacao'));
        }
        else{
            # code...
           /* if ($anu->tipoanuncio == 'Oferta'){
                $meusanuncios = Anuncio::where('idanunciante','=', Auth::user()->id)->Situacao()->where('tipoanuncio','=','demanda')->orderby('titulo')->get();
            }*/

                $meusanuncios = Anuncio::where('idanunciante','=', Auth::user()->id)->where('tipoanuncio','=','oferta')->Situacao()->orderby('titulo')->get();

            
           
            $amizades = Amizades::where('idsolicitado', '=', Auth::user()->id)
                ->join('users','users.id','amizades.idsolicitante')
                ->select('users.name as nome','amizades.idsolicitante as idanunciante','users.email as email',
                    'users.id as idamigo')
                ->where('amizades.situacao','=','ativa')
                ->where('users.id','!=',$idanunciante)
                ->get();

            $amizades2 = Amizades::where('idsolicitante', '=', Auth::user()->id)
                ->join('users','users.id','amizades.idsolicitado')
                ->select('amizades.idsolicitado as idanunciante','users.name as nome','users.email as email',
                    'users.id as idamigo')
                ->where('amizades.situacao','=','ativa')
                ->where('users.id','!=',$idanunciante)
                ->get();

             Return view('anuncios.exibeoutro',compact('anu','files','ende','user','amizades','amizades2','categoria','classificacao','meusanuncios'));
        }
           //->with('detanuncio', $detanuncio,$dir);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function edit(Anuncio $anuncio)

    {
        //
        $detanuncio = Anuncio::find($anuncio->id);

        $result = DB::table('cidades')->get();
        $estados = DB::table('ufs')->get();
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();
        $endereco = Endereco::find($anuncio->idendereco);
        //$endereco = DB::table('enderecos')->where('id','=',$detanuncio->idendereco);


        Return view('anuncios.edit', compact('result','estados','classificacoes','categorias','detanuncio','endereco'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $anu)
    {


        $anuncioa = Anuncio::findOrFail($anu);


        $input = $request->all();

        $anuncioa->fill($input)->save();
        //dd($anuncioa);
        $detanuncio = Anuncio::selecionaum($request)->get();

        $files = Storage::allFiles('Anuncios/'.$anu.'/');

        $endereco = Endereco::findOrFail($anuncioa->idendereco);
        $endereco->idpais=$request->get('pais');
        $endereco->iduf=$request->get('estado');
        $endereco->idcidade=$request->get('cidade');
        $endereco->bairro=$request->get('bairro');
        $endereco->rua=$request->get('rua');
        $endereco->numero=$request->get('numero');
        $endereco->observacao=$request->get('endobservacao');
        $endereco->save();



        //Session::flash('flash_message', 'Task successfully added!');
       
        //return view('anuncios.exibe', compact('detanuncio','files'));
        //return view('anuncios.exibe')->with('anuncio', $anuncio);
       // return $anuncio->id;
        return redirect()->route('anuncio.show',$anuncioa)->with('message','Anúncio atualizado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function inativar($id){


        $staff = Anuncio::find($id);

       // dd($staff);
        $staff->situacao = 'inativo';
        $staff->save();
        $anu = Anuncio::selecionaum($staff)->get();
        $files = Storage::allFiles('Anuncios/'.$id.'/');

            $casa = Casaofertademanda::where('iddemanda',$staff->id)->orWhere('idoferta', $staff->id)->get();
            
            foreach ($casa as $c) {
                    # code...
                    $casou = Casaofertademanda::findOrFail($c->id);
                    $casou->delete();
            }    
           // dd($casa);

       //


        //dd($detanuncio);
       // Session::flash('flash_message', 'Anuncio inativado!');
        //return view('anuncios.exibe', compact('anu','files'));
       return redirect()->route('anuncio.show',$staff)->with('message','Anúncio Inativado');    

    }
    public function destroy(Anuncio $anuncio)
    {
        //
        $passport= Anuncio::find($anuncio->get('id'));
        $passport->situacao='inativo';
        return redirect('anuncio.index');
    }
}
