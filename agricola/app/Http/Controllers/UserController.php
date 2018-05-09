<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Endereco;
use App\Anuncio;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        /*$endereco = Endereco::where('id','=', Auth::user()->idend)->join('cidades','cidades.cidade_codigo','=','enderecos.idcidade')->join('ufs','ufs.uf_codigo','=','enderecos.iduf')->join('paises','paises.numcode','=','enderecos.idpais')->get();*/

        $e=Endereco::Meuendereco()->count();
        if ($e>0) {
             $endereco=Endereco::Meuendereco()->get();
             
        }else
        {
            $endereco=null;
        }
        $dir= Auth::user()->id;
        $files = Storage::allFiles('Usuarios/'.$dir.'/');
        return view('users.exibir',compact('endereco','files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //

      //  $estados = DB::table('ufs')->get();
        $usuario = User::FindorFail($user->id);
        //dd($usuario);
        $classificacoes = DB::table('classificacaos')->get();
        $categorias = DB::table('categorias')->get();
        
        return view('users.editar',compact('usuario','classificacoes','categorias'));
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)

    {
        //
        $usuario = User::FindorFail(Auth::user()->id);
        $usuario->name = $request->name;
        $usuario->email =$request->email;
        $usuario->datanasc = $request->datanasc;
        $usuario->tipo = $request->tipo;
        if($request->tipo != 'CNPJ'){
            $usuario->sexo = $request->sexo;
            $usuario->cpf = $request->cpf;
        }
        else {
            $usuario->cnpj = $request->cnpj;
        }
        $usuario->save();
        return redirect()->route('user.show',[Auth::user()->id]);
    }

    public function inativar(User $user){
        

        $Anuncio = Anuncio::all()->where('idanunciante', '=',Auth::user()->id);
        foreach ($Anuncio as $anu) {
            $a = Anuncio::FindorFail($anu->id);
            $a->situacao = 'inativo';
            $a->save();
            # code...
        }
       // $Anuncio->situacao = 'inativo';
       // $Anuncio->save();
   //     dd($Anuncio);

        $usuario = User::FindorFail(Auth::user()->id);
        $usuario->situacao = '2';
        $usuario->save();

        Auth::logout();
        return redirect('/');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
