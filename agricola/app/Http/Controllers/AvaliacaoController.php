<?php

namespace App\Http\Controllers;

use App\avaliacao;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\avaliacao;
class AvaliacaoController extends Controller
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
    public function store(Request $request, $id)
    {
        //
        return 'chegou';
    }

    public function gravar(Request $request, $id)
    {
       // dd($request->nota.'-'.$request->comentario.'-'.$id);
        $avaliacao= new Avaliacao;
        $avaliacao->nota=        $request->nota;
        $avaliacao->comentario=  $request->comentario;
        $avaliacao->idavaliador= Auth::user()->id;
        $avaliacao->idavaliado=    $id;
        $avaliacao->save();
        return redirect()->back()->with('message','Avaliação Registrada!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\avaliacao  $avaliacao
     * @return \Illuminate\Http\Response
     */
    public function show(avaliacao $avaliacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\avaliacao  $avaliacao
     * @return \Illuminate\Http\Response
     */
    public function edit(avaliacao $avaliacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\avaliacao  $avaliacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, avaliacao $avaliacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\avaliacao  $avaliacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(avaliacao $avaliacao)
    {
        //
    }
}
