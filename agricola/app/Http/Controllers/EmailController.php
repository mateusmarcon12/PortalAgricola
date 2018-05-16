<?php

namespace App\Http\Controllers;

use App\email;
use App\Mail\mailEnviar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Anuncio;
use App\User;
use Auth;
Use App\Conversa;
Use App\Mensagens;
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
        
        $anunciosugerido = Anuncio::Findorfail($request->sugerido);
        //dd($anunciosugerido);

        $anu= Anuncio::Findorfail($anuncio);
        $anunciante = User::Findorfail($anu->idanunciante);
       // dd($request->assunto.'-'.$request->mensagem.' email:'.$anu->titulo.' Anunciante:'.$anunciante->name);
        $dados = [$request->assunto,$request->mensagem,$anunciante->email];
        $data = array('destinatario'=>$anunciante->email,'mensagem'=>$request->mensagem, 'assunto'=> $request->assunto,'remetente'=>Auth::user()->email, 'titulo'=> $anunciosugerido->titulo,'validade'=> $anunciosugerido->datavalidade);

        Mail::send('emails.padrao',$data,function($message) use ($data){
            $message->to($data['destinatario']);
            $message->from($data['remetente']);
            $message->subject($data['assunto']);
        });

        //Mail::to($anunciante->email)->send(new mailEnviar())->subject('teste');
        $conversa = Conversa::where('idusuario1','=',Auth::user()->id)->where('idusuario2','=',$anunciante->id)->count();

        $conversa2 = Conversa::where('idusuario1','=',$anunciante->id)->where('idusuario2','=',Auth::user()->id)->count();
        if (($conversa == 0)&&($conversa2==0)){
            $conversa1 = new Conversa();
            $conversa1->idusuario1 = Auth::user()->id;
            $conversa1->idusuario2 = $anunciante->id;
            $conversa1->save();
        }
        if (($conversa > 0)&&($conversa2==0)) {
            # code...
            
            $conversa1 = Conversa::where('idusuario1','=',Auth::user()->id)->where('idusuario2','=',$anunciante->id)->first();
            
            $mensagem = new Mensagens();
            $mensagem->idremetente = Auth::user()->id;
            $mensagem->idconversa = $conversa1->id;
            $mensagem->mensagem = 'Assunto: '.$request->assunto.'. Estou interessado no seu anúncio: '.$anu->titulo.'. Mensagem: '.$request->mensagem.'. Acho que você pode interessar-se pelo meu anúncio: '.$anunciosugerido->titulo;
            $mensagem->save();
        }
        if (($conversa == 0)&&($conversa2>0)) {
            # code...
            $conversa1 = Conversa::where('idusuario1','=',$anunciante->id)->where('idusuario2','=',Auth::user()->id)->first();
            $mensagem = new Mensagens();
            $mensagem->idremetente = Auth::user()->id;
            $mensagem->idconversa = $conversa1->id;
            $mensagem->mensagem = 'Assunto: '.$request->assunto.'. Estou interessado no seu anúncio: '.$anu->titulo.'. Mensagem: '.$request->mensagem.'. Acho que você pode interessar-se pelo meu anúncio: '.$anunciosugerido->titulo;
            $mensagem->save();
            
        }
        
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
