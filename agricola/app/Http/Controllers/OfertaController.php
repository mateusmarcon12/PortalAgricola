<?php

namespace App\Http\Controllers;

use App\Oferta;
use App\Anuncio;
use App\Categoria;
use App\Classificacao;
use App\Endereco;
use App\Cidade;
use App\Pais;
use App\Uf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OfertaController extends Controller
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
        return view('ofertas.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
/*
        $paises = DB::table('paises')->get();
        $ufs = DB::table('ufs')->get();
        $cidades = DB::table('cidades')->get();

        $ufs = Uf::all();
        $paises = Pais::all();
       $cidades= cidade::all();*/
        $result = DB::table('cidades')->get();
        $estados = DB::table('ufs')->get();
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();
        $tipoanuncio='oferta.store';
        $nomeanuncio='Oferta';

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
        $a->quantidade=$request->get('quantidade');
        $a->unidademedida=$request->get('unidademedida');
        $a->observacao=$request->get('observacao');
        $a->situacao='ativo';
        $a->idendereco=$ideste;
        $a->tipoanuncio='Oferta';
        $a->save();
        $fotoend=$a->id;
    /*    if ($request->hasFile('images')){
            $this->validate($request, [
                'images' => 'mimes:jpeg,bmp,png', //only allow this type extension file.
            ]);

          //  $file = $request->file('images');
         //   $extension=$file->getClientOriginalExtension();
            // image upload in public/upload folder.
            //$file->move('uploads/anuncio'.$fotoend.'/', $file->getClientOriginalName());
            $file = $request->file('images')->store('Anuncios/'.$fotoend);
        }
*/
        if ($request->hasFile('images')){

            $this->validate($request, [
                'images' => 'mimes:jpeg,bmp,png', //only allow this type extension file.
            ]);

            //$file = $request->file('images');
            //$extension=$file->getClientOriginalExtension();
            // image upload in public/upload folder.
            //$file->move('uploads/anuncio/'.$fotoend.'/', $file->getClientOriginalName());
            $file = $request->file('images')->store('Anuncios/'.$fotoend);
        }
        return redirect('anuncio')->with('success', 'Oferta Cadastrada teste');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function show(Oferta $oferta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function edit(Oferta $oferta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Oferta $oferta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oferta $oferta)
    {
        //
    }
}
