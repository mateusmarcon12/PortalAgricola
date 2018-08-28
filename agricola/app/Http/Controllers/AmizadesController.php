<?php

namespace App\Http\Controllers;

use App\Amizades;
use App\Solicitacao;
use Illuminate\Http\Request;
use Auth;
use App\user;
use Illuminate\Support\Facades\Input;

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

        $solicitacoes = Solicitacao::where('idsolicitado','=',Auth::user()->id)
            ->where('solicitacaos.situacao','=','pendente')
            ->join('users','users.id','solicitacaos.idsolicitante')
            ->select('users.name as name','users.email as email','solicitacaos.id as idsolicitacao')
            ->orderby('users.name','asc')
            ->paginate(10);

        $amizades = Amizades::leftjoin('users as solicitante','solicitante.id','=','amizades.idsolicitante')
            ->leftjoin('users as solicitado','solicitado.id','=','amizades.idsolicitado')
            ->where(function ($query) {
                $query->where('idsolicitado', '=', Auth::user()->id)
                    ->orWhere('idsolicitante', '=', Auth::user()->id);
            })
            ->select('solicitante.id as idsolicitante','solicitante.name as namesolicitante','solicitante.email as emailsolicitante',
                'solicitado.id as idsolicitado','solicitado.name as namesolicitado','solicitado.email as emailsolicitado',
                'amizades.id as idamizade')
            ->where('amizades.situacao','=','ativa')
            ->paginate(10);


        return view('amizades.home',compact('amizades','solicitacoes'));
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

    public  function filtrar(){
        $solicitacoes = Solicitacao::where('idsolicitado','=',Auth::user()->id)
            ->where('solicitacaos.situacao','=','pendente')
            ->join('users','users.id','solicitacaos.idsolicitante')
            ->select('users.name as name','users.email as email','solicitacaos.id as idsolicitacao')
            ->orderby('users.name','asc')
            ->paginate(10);


        $nome = Input::get('nome');
        $email = Input::get('email');


        $q = Amizades::join('users as solicitante','solicitante.id','=','amizades.idsolicitante')
            ->join('users as solicitado','solicitado.id','=','amizades.idsolicitado')
            ->where(function ($query) {
                $query->where('idsolicitado', '=', Auth::user()->id)
                    ->orWhere('idsolicitante', '=', Auth::user()->id);
            })
            ->select('solicitante.id as idsolicitante','solicitante.name as namesolicitante','solicitante.email as emailsolicitante',
                'solicitado.id as idsolicitado','solicitado.name as namesolicitado','solicitado.email as emailsolicitado',
                'amizades.id as idamizade')
            ->where('amizades.situacao','=','ativa');


        if($nome){
            $q->where(function ($q) use ($nome) {
                $q->where('solicitado.name', '=', $nome)
                    ->orWhere('solicitante.name', '=', $nome);
            });
        }
        if($email){
            $q->where(function ($q) use ($email) {
                $q->where('solicitado.email', '=', $email)
                    ->orWhere('solicitante.email', '=', $email);
            });
        }

        $amizades = $q->paginate(10);

        return view('amizades.home',compact('amizades','solicitacoes'));
    }

}
