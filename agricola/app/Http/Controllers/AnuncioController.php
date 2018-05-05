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
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Storage;

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

        $anu = Anuncio::where('idanunciante','=', Auth::user()->id)->get();
        return view('anuncios.home')->with('anu', $anu);

    }


    //exibir todos os anúncios ativos de outros usuários
    public function todosanuncios(){

        $anu = Anuncio::join('users','users.id','=','anuncios.idanunciante')->where('idanunciante','!=', Auth::user()->id)->where('anuncios.situacao','=','ativo')->orderby('anuncios.created_at','desc')->get();
         $estados = DB::table('ufs')->get();
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();
        
        return view('anuncios.todos',compact('anu','estados','classificacoes','categorias'));
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

    public function filtra(Request $request)
    {

        $categoria = $request->categoria;
        $classificacao = $request->classificacao;
        $titulo = $request->titulo;
        $estado = $request->estado;
        $tipo = $request->tipo;


        $query = Anuncio::Situacao()->join('enderecos','enderecos.id','=','Anuncios.idendereco');

        if($titulo)
            $query->where('titulo', 'LIKE', '%' . $titulo . '%');

        if($classificacao)
            $query->where('tipo', '=', $classificacao);

        if($categoria)
            $query->where('classe', '=', $categoria);

        if($tipo)
            $query->where('tipoanuncio', '=', $tipo);

        if($estado)
            $query->where('enderecos.iduf', '=', $estado);

        $anu = $query->orderBy('anuncios.created_at', 'desc')->where('idanunciante','!=', Auth::user()->id)->get();

        $estados = DB::table('ufs')->get();
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();

        return view('anuncios.todos',compact('anu','estados','classificacoes','categorias'));

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
        //

        $detanuncio = Anuncio::selecionaum($anuncio)->get();
        foreach ($detanuncio as $a){
            $dir = $a->ida;
        }
        //dd($dir)
      //  $files = Storage::allFiles('public/Anuncios/'.$dir);
        $files = Storage::allFiles('Anuncios/'.$dir.'/');

     //   dd($files);
        
       // echo ("<img id='myImg'src='Storage::url('app/fotos/imagem3.jpg')");

       Return view('anuncios.exibe',compact('detanuncio','files'));
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
//dd($detanuncio);
        $result = DB::table('cidades')->get();
        $estados = DB::table('ufs')->get();
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();
        $endereco = Endereco::find($anuncio->idendereco);
        //$endereco = DB::table('enderecos')->where('id','=',$detanuncio->idendereco);


      //  $detanuncio = Anuncio::find($anuncio);
        //return view('ofertas.cadastrar')->with('data', $result);
        //$detanuncio = Anuncio::selecionaum($anuncio)->get();
       //dd($detanuncio);
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
        $detanuncio = Anuncio::selecionaum($request)->get();
        //Session::flash('flash_message', 'Task successfully added!');
        Return view('anuncios.exibe')->with('detanuncio', $detanuncio);
        //return view('anuncios.exibe')->with('anuncio', $anuncio);
       // return $anuncio->id;

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
        $detanuncio = Anuncio::selecionaum($staff)->get();
        //dd($detanuncio);
       // Session::flash('flash_message', 'Anuncio inativado!');
        return view('anuncios.exibe')->with('detanuncio', $detanuncio);

    }
    public function destroy(Anuncio $anuncio)
    {
        //
        $passport= Anuncio::find($anuncio->get('id'));
        $passport->situacao='inativo';
        return redirect('anuncio.index');
    }
}
