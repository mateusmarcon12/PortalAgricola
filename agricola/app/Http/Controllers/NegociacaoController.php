<?php

namespace App\Http\Controllers;

use App\Negociacao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Anuncio;
use App\Mensagens;

class NegociacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $negociacaos1 = Negociacao::join('anuncios','anuncios.id','=','negociacaos.idanuncio1')->where('anuncios.idanunciante','=',Auth::user()->id)->select('negociacaos.id as idnegociacao','anuncios.titulo','negociacaos.situacao as situacao','negociacaos.resultado as resultado')->get();
        //dd($negociacaos1);

        $negociacaos2 = Negociacao::join('anuncios','anuncios.id','=','negociacaos.idanuncio2')->where('anuncios.idanunciante','=',Auth::user()->id)->select('negociacaos.id as idnegociacao','anuncios.titulo','negociacaos.situacao as situacao','negociacaos.resultado as resultado')->get();
     //  dd($negociacaos2);

        return view('negociacoes.home',compact('negociacaos2','negociacaos1'));
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
    public function store(Request $request, $negociacao)
    {
        //
        $mensagem = new Mensagens();
        $mensagem->idconversa = $negociacao;
        $mensagem->idremetente = Auth::user()->id;
        $mensagem->mensagem = 'Assunto: '.$request->assunto.'. Mensagem: '.$request->mensagem;
            $mensagem->save();
        return redirect()->back()->with('message','Mensagem enviada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Negociacao  $negociacao
     * @return \Illuminate\Http\Response
     */
    public function show($negociacao)
    {
        //
        $neg = Negociacao::Findorfail($negociacao);
        $anuncio1 = Anuncio::Findorfail($neg->idanuncio1);
        $anuncio2 = Anuncio::Findorfail($neg->idanuncio2);
        $mensagem = Mensagens::where('idconversa','=',$neg->id)->join('users','users.id','=','mensagens.idremetente')->orderby('mensagens.created_at')->get();
        //dd($mensagens);
        return view('negociacoes.negociacao', compact('anuncio1','anuncio2','neg','mensagem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Negociacao  $negociacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Negociacao $negociacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Negociacao  $negociacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Negociacao $negociacao)
    {
        //
    }

    public function finalizar(Request $request, $negociacao){
       // dd($request->nota);
        
        $neg = Negociacao::Findorfail($negociacao);
        $neg->resultado = $request->nota;
        $neg->situacao = 'inativa';
        $neg->save();
        if ($request->nota == 'sucesso'){
            $anuncio1 = Anuncio::Findorfail($neg->idanuncio1);
            $anuncio1->situacao = 'inativo';
            $anuncio1->save();
            if($neg->idanuncio2 != null){
                $anuncio2 = Anuncio::Findorfail($neg->idanuncio2);
                $anuncio2->situacao = 'inativo';
                $anuncio2->save();
            }
        }
        else{
            $anuncio1 = Anuncio::Findorfail($neg->idanuncio1);
            $anuncio1->situacao = 'ativo';
            $anuncio1->save();
            if($neg->idanuncio2 != null){
                $anuncio2 = Anuncio::Findorfail($neg->idanuncio2);
                $anuncio2->situacao = 'ativo';
                $anuncio2->save();
            }
        }

        return redirect()->route('negociacao.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Negociacao  $negociacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Negociacao $negociacao)
    {
        //
    }
}