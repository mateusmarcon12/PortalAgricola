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
Use App\Negociacao;
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
        
        //informações passadas no e-mail
        if($request->sugerido != null){
            $anunciosugerido = Anuncio::Findorfail($request->sugerido);
            $data = array('destinatario'=>$anunciante->email,'mensagem'=>$request->mensagem, 'assunto'=> $request->assunto,'remetente'=>Auth::user()->email, 'titulo'=> $anunciosugerido->titulo,'validade'=> $anunciosugerido->datavalidade);



        }    
        else{
            $data = array('destinatario'=>$anunciante->email,'mensagem'=>$request->mensagem, 'assunto'=> $request->assunto,'remetente'=>Auth::user()->email);
        }

        //envia e-mail
        Mail::send('emails.padrao',$data,function($message) use ($data){
                $message->to($data['destinatario']);
                $message->from($data['remetente']);
                $message->subject($data['assunto']);
        });
           
        //salva negociação        
        $negociacao = New Negociacao();
        $negociacao->idanuncio1 = $anuncio;
        if($request->sugerido != null){
                $negociacao->idanuncio2 = $request->sugerido;
        } 
        $negociacao->idusuario1 = $anu->idanunciante; 
        $negociacao->idusuario2 = Auth::user()->id;
        $negociacao->situacao = 'ativa';
        $negociacao->save();
        $idnegociacao = $negociacao->id;


        //salva mensagem
        $mensagem = new Mensagens();
        $mensagem->idremetente = Auth::user()->id;
        $mensagem->idconversa = $idnegociacao;
        if($request->sugerido != null){
            $mensagem->mensagem = 'Estou interessado no seu anúncio: '.$anu->titulo.'. Mensagem: '.$request->mensagem.'. Acho que você pode interessar-se pelo meu anúncio: '.$anunciosugerido->titulo;
        }else{
            $mensagem->mensagem = 'Estou interessado no seu anúncio: '.$anu->titulo.'. Mensagem: '.$request->mensagem;
        }
        $mensagem->save();


        $anuncio1 = Anuncio::Findorfail($anuncio);
        $anuncio1->situacao = "negociacao";
        $anuncio1->save();

            //dd($anuncio1);
        if($request->sugerido != null){
                $anuncio2 = Anuncio::Findorfail($request->sugerido);
                $anuncio2->situacao = "negociacao";
                $anuncio2->save();
        }
         
        return redirect()->back()->with('message','E-mail enviado ao anunciante e aberta negociação. A partir de agora os anuncios não estão mais visiveis aos demais usuários');
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
