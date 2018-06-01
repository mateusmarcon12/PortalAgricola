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
        $meuid=Auth::user()->id;
        $negociacaos = Negociacao::join('users as anunciantes1','anunciantes1.id','=','negociacaos.idusuario1')
            ->join('users as anunciantes2','anunciantes2.id','=','negociacaos.idusuario2')
            ->select('anunciantes1.name as nomeanunciante1', 'anunciantes2.name as nomeanunciante2',
                'negociacaos.id as idnegociacao','anunciantes1.id as idanunciante1','anunciantes2.id as idanunciante2',
                'negociacaos.situacao as situacaonegociacao',
                'negociacaos.resultado as resultadonegociacao')
            ->where('anunciantes2.id','=',$meuid)
              ->orwhere('anunciantes1.id','=',$meuid)
            ->paginate(25);
          //  dd($negociacaos);



/*

        $negociacaos1 = Negociacao::join('users','users.id','=','negociacaos.idusuario2')
            ->where('idusuario1','=', Auth::user()->id)
            ->select('negociacaos.id as idnegociacao','negociacaos.situacao as situacaonegociacao',
                'negociacaos.resultado as resultadonegociacao','users.name as nomeanunciante')->get();


        $negociacaos2 = Negociacao::join('users','users.id','=','negociacaos.idusuario1')
            ->where('idusuario2','=', Auth::user()->id)
            ->select('negociacaos.id as idnegociacao','negociacaos.situacao as situacaonegociacao',
                'negociacaos.resultado as resultadonegociacao','users.name as nomeanunciante')->get();
      //dd($negociacaos2);

       // dd($negociacaos2);
        return view('negociacoes.home',compact('negociacaos2','negociacaos1'));
*/
        return view('negociacoes.home',compact('negociacaos'));
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
        $mensagem->mensagem = 'Mensagem: '.$request->mensagem;
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
        
        $neg = Negociacao::Findorfail($negociacao);
        $anuncio1 = Anuncio::Findorfail($neg->idanuncio1);
        if($neg->idanuncio2 != null){
            $anuncio2 = Anuncio::Findorfail($neg->idanuncio2);
        }
        $mensagem = Mensagens::where('idconversa','=',$neg->id)->join('users','users.id','=','mensagens.idremetente')->orderby('mensagens.created_at')->get();
        //dd($mensagens);
        return view('negociacoes.negociacao', compact('anuncio1','anuncio2','neg','mensagem'));
        //return "chegou";
    }


    //filtrar anuncios
    public function filtrar(Request $request)
    {
        $meuid = Auth::user()->id;
        $resolucao = $request->resolucao;
        $situacao = $request->situacao;


        $query = Negociacao::join('users as anunciantes1', 'anunciantes1.id', '=', 'negociacaos.idusuario1')
            ->leftjoin('users as anunciantes2', 'anunciantes2.id', '=', 'negociacaos.idusuario2')
            ->select('anunciantes1.name as nomeanunciante1', 'anunciantes2.name as nomeanunciante2',
                'negociacaos.id as idnegociacao', 'anunciantes1.id as idanunciante1', 'anunciantes2.id as idanunciante2',
                'negociacaos.situacao as situacaonegociacao',
                'negociacaos.resultado as resultadonegociacao');


        if ($resolucao) {
            $query->where('negociacaos.resultado', '=', $resolucao);

        } elseif ($situacao){
            $query->where('negociacaos.situacao', '=', $situacao);
        }


      //dd($negociacaos2);
        $negociacaos = $query->where(function ($query) use ($meuid) {
            $query->where('anunciantes2.id','=',$meuid)
                ->orwhere('anunciantes1.id','=',$meuid);})->paginate(25);

       // dd($negociacaos2);
        return view('negociacoes.home',compact('negociacaos'));

      //  return "chegou";
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
