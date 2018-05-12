<?php

namespace App\Http\Controllers;

use App\Amizades;
use App\Solicitacao;
use Illuminate\Http\Request;
use Auth;
use App\user;

class AmizadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Amizades  $amizades
     * @return \Illuminate\Http\Response
     */
    public function show()
    {



        $amizades = Amizades::where('idsolicitado', '=', Auth::user()->id)
            ->join('users','users.id','amizades.idsolicitante')
            ->select('users.name as nome','amizades.idsolicitante as idanunciante','users.email as email',
                'amizades.id as idamizade')
            ->where('amizades.situacao','=','ativa')
            ->get();

        $amizades2 = Amizades::where('idsolicitante', '=', Auth::user()->id)
            ->join('users','users.id','amizades.idsolicitado')
            ->select('amizades.idsolicitado as idanunciante','users.name as nome','users.email as email',
                'amizades.id as idamizade')
            ->where('amizades.situacao','=','ativa')
            ->get();

        //dd($amizades);
        return view('amizades.home',compact('amizades','amizades2'));
    }

    public function excluir($id){

        $amizade = Amizades::findorfail($id);
        $amizade->delete();
        $solicitacao = Solicitacao::where('idsolicitante','=',$amizade->idsolicitante)->where('idsolicitado','=',$amizade->idsolicitado)->first();
        $solicitacao->delete();
        return redirect()->back()->with('message','Vinculo de amizade excluído');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Amizades  $amizades
     * @return \Illuminate\Http\Response
     */
    public function edit(Amizades $amizades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Amizades  $amizades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Amizades $amizades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Amizades  $amizades
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amizades $amizades)
    {
        //
    }
}
