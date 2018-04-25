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
use Illuminate\Support\Facades\DB;
use Auth;

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


       Return view('anuncios.exibe')->with('detanuncio', $detanuncio);

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
