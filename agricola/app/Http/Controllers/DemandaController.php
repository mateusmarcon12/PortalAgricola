<?php

namespace App\Http\Controllers;

use App\Anuncio;
use App\Demanda;
use Illuminate\Http\Request;
use App\Oferta;
use App\Categoria;
use App\Classificacao;
use App\Endereco;
use App\Cidade;
use App\Pais;
use App\Uf;
use App\Foto;
use Illuminate\Support\Facades\DB;

class DemandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
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
        $tipoanuncio='demanda.store';
        $nomeanuncio='Demanda';

        return view('anuncios.cadastrar', compact('result','estados','classificacoes','categorias','tipoanuncio','nomeanuncio'));
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
        $endereco = new Endereco();
        $endereco->idpais=$request->get('pais');
        $endereco->iduf=$request->get('estado');
        $endereco->idcidade=$request->get('cidade');
        $endereco->bairro=$request->get('bairro');
        $endereco->rua=$request->get('rua');
        $endereco->numero=$request->get('numero');
        $endereco->observacao=$request->get('endobservacao');
        $endereco->save();

        $ideste=$endereco->id;

        $a = new Anuncio();
        $a->idanunciante=auth()->user()->id;

        $a->titulo=$request->get('titulo');
        $a->descricao=$request->get('descricao');
        $a->tipo=$request->get('tipo');
        $a->classe=$request->get('categoria');
        $a->datavalidade=$request->get('datavalidade');
        $a->observacao=$request->get('observacao');
        $a->quantidade=$request->get('quantidade');
        $a->unidademedida=$request->get('unidademedida');
        $a->situacao='ativo';
        $a->idendereco=$ideste;
        $a->tipoanuncio='demanda';
        $a->save();
        $fotoend=$a->id;
        if ($request->hasFile('images')){

                $this->validate($request, [
                    'images' => 'mimes:jpeg,bmp,png', //only allow this type extension file.
                ]);

                //$file = $request->file('images');
                $extension=$file->getClientOriginalExtension();
                // image upload in public/upload folder.
                //$file->move('uploads/anuncio/'.$fotoend.'/', $file->getClientOriginalName());
                $file = $request->file('images')->store('Anuncios/'.$fotoend);
            }

        return redirect('anuncio')->with('success', 'Demanda Cadastrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Demanda  $demanda
     * @return \Illuminate\Http\Response
     */
    public function show(Demanda $demanda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Demanda  $demanda
     * @return \Illuminate\Http\Response
     */
    public function edit(Demanda $demanda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Demanda  $demanda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demanda $demanda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Demanda  $demanda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demanda $demanda)
    {
        //
    }
}
