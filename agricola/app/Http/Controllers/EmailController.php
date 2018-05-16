<?php

namespace App\Http\Controllers;

use App\email;
use App\Mail\mailEnviar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Anuncio;
use App\User;
use Auth;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
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

    public function enviar(Request $request, $anuncio){
        
        

        $anu= Anuncio::Findorfail($anuncio);
        $anunciante = User::Findorfail($anu->idanunciante);
       // dd($request->assunto.'-'.$request->mensagem.' email:'.$anu->titulo.' Anunciante:'.$anunciante->name);
        $dados = [$request->assunto,$request->mensagem,$anunciante->email];
        $data = array('destinatario'=>$anunciante->email,'mensagem'=>$request->mensagem, 'assunto'=> $request->assunto,'remetente'=>Auth::user()->email);

        Mail::send('emails.padrao',$data,function($message) use ($data){
            $message->to($data['destinatario']);
            $message->from($data['remetente']);
            $message->subject($data['assunto']);
        });

        //Mail::to($anunciante->email)->send(new mailEnviar())->subject('teste');



        return redirect()->back()->with('message','E-mail enviado ao Anunciante');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(email $email)
    {
        //
    }
}
