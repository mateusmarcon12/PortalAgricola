<?php

namespace App\Http\Controllers;

use App\Recomendacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RecomendacaoController extends Controller
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
        return redirect()->back()->with('message','Anuncio recomendado');
    }
    public function guardar(Request $request,$id)
    {
        //
        $recomendacao= new Recomendacao();
        $recomendacao->idrecomendante=Auth::User()->id;
        $recomendacao->idrecomendado=$request->recomendado;
        $recomendacao->idanuncio=$id;
        $recomendacao->save();
        return redirect()->back()->with('message','Anuncio recomendado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recomendacao  $recomendacao
     * @return \Illuminate\Http\Response
     */
    public function show(Recomendacao $recomendacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recomendacao  $recomendacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Recomendacao $recomendacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recomendacao  $recomendacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recomendacao $recomendacao)
    {
        //
    }

    public function excluir($id){
        $recomendacao = Recomendacao::findorfail($id);
        $recomendacao->delete();

        return redirect()->back()->with('message','Recomendação excluída');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recomendacao  $recomendacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recomendacao $recomendacao)
    {
        //
    }
}
