<?php

namespace App\Http\Controllers;

use App\Conversa;
use App\Mensagens;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;


class ConversaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return "chegou";

        $conversas = Conversa::where('idusuario1','=',Auth::user()->id)->orWhere('idusuario2','=',Auth::user()->id)->get();

        return view('conversas.home',compact('conversas'));

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
     * @param  \App\Conversa  $conversa
     * @return \Illuminate\Http\Response
     */
    public function show($conversa)
    {
        //
       // dd($conversa);
        $con = Conversa::Findorfail($conversa);
       /* dd($con);
        $usuario1 = User::Findorfail($con->idusuario1)->select('users.name','users.id');
        $usuario2 = User::Findorfail($con->idusuario2)->select('users.name','users.id')->get();
        dd($usuario1);*/
        $mensagens = Mensagens::where('idconversa','=', $conversa)->get();
       // dd($mensagens);

        return view('conversas.mensagens',compact('mensagens','usuario1','usuario2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conversa  $conversa
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversa $conversa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conversa  $conversa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversa $conversa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conversa  $conversa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversa $conversa)
    {
        //
    }
}
