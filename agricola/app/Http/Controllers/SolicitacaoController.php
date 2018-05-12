<?php

namespace App\Http\Controllers;

use App\Amizades;
use App\Solicitacao;
use Illuminate\Http\Request;
use Auth;

class SolicitacaoController extends Controller
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
    public function create($id)
    {
        //
        dd($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        //
        $solicitacoes = Solicitacao::where('idsolicitante','=',Auth::user()->id)->where('idsolicitado','=',$id)->count();
        $solicitacoes2 = Solicitacao::where('idsolicitado','=',Auth::user()->id)->where('idsolicitante','=',$id)->count();

        if($solicitacoes>0){
            $solicitacoes3 = Solicitacao::where('idsolicitante','=',Auth::user()->id)->where('idsolicitado','=',$id)->First();
          //  dd($solicitacoes3->situacao);
            return redirect()->back()->with('message','Você já fez uma solicitação para este Anunciante e a situação é: '.$solicitacoes3->situacao);
        }
        if($solicitacoes2>0){
            $solicitacoes4 = Solicitacao::where('idsolicitado','=',Auth::user()->id)->where('idsolicitante','=',$id)->First();
         //   dd($solicitacoes4);
            if($solicitacoes4->situacao == 'pendente'){
                $solicitacoes4->situacao='aceita';
                $solicitacoes4->save();
                $amizade = new Amizades();
                $amizade->idsolicitante=$id;
                $amizade->idsolicitado=Auth::user()->id;
                $amizade->situacao = 'ativa';
                $amizade->save();
            }

            return redirect()->back()->with('message', 'Vinculo de Amizade estabelecido');
        }
        if(($solicitacoes==0)&&($solicitacoes2==0)) {
            $solicitacao = new Solicitacao();
            $solicitacao->idsolicitante = Auth::user()->id;
            $solicitacao->idsolicitado = $id;
            $solicitacao->situacao = 'pendente';
            $solicitacao->save();
            return redirect()->back()->with('message', 'Solicitação enviada');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Solicitacao  $solicitacao
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitacao $solicitacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solicitacao  $solicitacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitacao $solicitacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solicitacao  $solicitacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitacao $solicitacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solicitacao  $solicitacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitacao $solicitacao)
    {
        //
    }
}
