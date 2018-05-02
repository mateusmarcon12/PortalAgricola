<?php

namespace App\Http\Controllers;

use App\Endereco;
use Illuminate\Http\Request;
use App\Cidade;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\User;

class EnderecoController extends Controller
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
        $cidades = DB::table('cidades')->get();
        $estados = DB::table('ufs')->get();
        return view('enderecos.cadastrar',compact('cidades','estados'));
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
        $endereco->observacao=$request->get('observacao');
        $endereco->save();

        $ideste=$endereco->id;

        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['idend' => $ideste]);
        return redirect()->route('user.show',[Auth::user()->id]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function show(Endereco $endereco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function edit(Endereco $endereco)
    {
        //
        $ende = DB::table('enderecos')->where('id','=',Auth::user()->idend)->get();

        $cidades = DB::table('cidades')->get();
        $estados = DB::table('ufs')->get();
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();
        
        return view('enderecos.editar',compact('estados','classificacoes','categorias','ende','cidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    /*
    public function update(Request $request, $endereco)
    //public function update(Request $request)
    {
        //
      
        return redirect()->back();
    }
*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Endereco $endereco)
    {
        //
    }

    public function cidade($id){
        dd('chegou');
    }
}
