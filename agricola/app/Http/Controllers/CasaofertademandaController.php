<?php

namespace App\Http\Controllers;

use App\Casaofertademanda;
use App\Oferta;
use Illuminate\Http\Request;
use App\Anuncio;
use Illuminate\Support\Facades\DB;
use Auth;

class CasaofertademandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    }

    public function index()
    {
        //
        $ofer = Anuncio::Anunciante()->Situacao()->Tipooferta()->get();
        $deman = Anuncio::Meusanuncios()->Situacao()->Tipodemanda()->get();



        $i=0;

        foreach ($deman as $demandas){

            foreach ($ofer as $ofertas) {
                $grau = 0;
                $verifica = 0;
                $verifica2=0;
                if ($ofertas->titulo == $demandas->titulo) {
                    $grau = $grau + 5;
                }
              echo "<script>console.log( $grau.$ofertas->id);</script>";


                if ($ofertas->categoria == $demandas->categoria) {
                    $grau = $grau +2;
                    echo "<script>console.log( $grau.$ofertas->id);</script>";
                }


                if ($ofertas->tipo == $demandas->tipo) {
                    $grau = $grau + 3;
                    echo "<script>console.log( $grau.$ofertas->id);</script>";
                }


                if ($grau > 0) {
                    $casa = new Casaofertademanda();

                    $casa->idoferta = $ofertas->id;
                    $casa->iddemanda = $demandas->id;
                    $casa->iddemandador = $demandas->idanunciante;
                    $casa->graucompatibilidade = $grau;
                    $casa->tipoanuncio = $ofertas->tipoanuncio;
                    $casa->idofertante = $ofertas->idanunciante;

                    //   $matches[$i]=$casa;
                    $verifica = Casaofertademanda::where('idoferta', '=', $casa->idoferta)->where('iddemanda', '=', $casa->iddemanda)->count();
                    //var_dump($matches[$i]);
                    if ($verifica == 0) {
                        $verifica2 = Casaofertademanda::where('idoferta', '=', $casa->idoferta)->where('iddemandador', '=', $casa->iddemandador)->count();
                        if($verifica2==0){
                            $casa->save();

                        }}
                    else{
                            $ver = Casaofertademanda::where('idoferta', '=', $casa->idoferta)->where('iddemandador', '=', $casa->iddemandador)->get();

                            foreach($ver as $veri) {

                                if ($veri->graucompatibilidade < $grau) {
                                   // $verif = Casaofertademanda::where('id','=',$veri->id)->get();
                                    $verif = Casaofertademanda::findOrFail($veri->id);
                                    $verif->graucompatibilidade = $grau;
                                    $verif->save();

                                }
                            }
                    }
                }
            }

        }

        $minhasofertas = Anuncio::Meusanuncios()->Tipooferta()->Situacao()->get();
        $demandasoutros = Anuncio::Anunciante()->Tipodemanda()->Situacao()->get();


        foreach ($minhasofertas as $md){
            foreach ($demandasoutros as $do){
                $g=0;
                if($md->titulo == $do->titulo){
                    $g = 5;
                }
                if($md->tipo == $do->tipo ){
                    $g=$g+3;
                }
                if($md->categoria == $do->categoria){
                    $g=$g+2;
                }

                if($g>0) {
                    $casou = new Casaofertademanda;

                    $casou->idoferta = $md->id;
                    $casou->iddemanda = $do->id;
                    $casou->iddemandador = $do->idanunciante;
                    $casou->tipoanuncio = $do->tipoanuncio;
                    $casou->idofertante = $md->idanunciante;
                    $casou->graucompatibilidade = $g;
                    $ch=0;
                    $ch = Casaofertademanda::where('idoferta', '=', $casou->idoferta)->where('iddemanda', '=', $casou->iddemanda)->count();


                    if($ch == 0){
                        $vv2 = Casaofertademanda::where('idoferta', '=', $casou->idoferta)->where('idofertante', '=', $casou->idofertante)->count();
                        if($vv2==0) {
                            $casou->save();
                        }
                    }
                    else{

                        $ch2=0;
                        $ch2 = Casaofertademanda::where('idoferta', '=', $casou->idoferta)->where('iddemanda', '=', $casou->iddemanda)->get();


                         foreach($ch2 as $c) {

                             if ($c->graucompatibilidade < $g) {
                                 // $verif = Casaofertademanda::where('id','=',$veri->id)->get();
                                 $cf = Casaofertademanda::findOrFail($c->id);
                                 $cf->graucompatibilidade = $g;
                                 $cf>save();

                             }
                         }
                    }
                }


            }
        }



    $anu = Casaofertademanda::
        join('anuncios as ofertas', 'ofertas.id', '=', 'casaofertademandas.idoferta')
        ->join('anuncios  as demandas', 'demandas.id', '=','casaofertademandas.iddemanda')
        ->join('users as ofertante', 'ofertante.id', '=','casaofertademandas.idofertante')
        ->join('users as demandador', 'demandador.id', '=','casaofertademandas.iddemandador')
        ->select('ofertas.titulo as titulooferta','ofertas.descricao as ofertadescricao','ofertas.datavalidade as validadeoferta',
            'demandas.titulo as titulodemanda', 'demandas.descricao as descdemanda','demandas.datavalidade as validadedemanda',
            'demandas.tipoanuncio as demandatipo','ofertas.tipoanuncio as ofertatipo',
            'casaofertademandas.graucompatibilidade',
            'demandador.id as demandadorid', 'ofertante.id as idof',
            'demandador.name as demandadornome','ofertante.name as ofertantenome',
            'casaofertademandas.idoferta as idoferta','casaofertademandas.iddemanda as iddemanda')
        ->where('casaofertademandas.iddemandador','=', Auth::user()->id)
        ->orwhere('casaofertademandas.idofertante','=', Auth::user()->id)
        ->orderby('casaofertademandas.graucompatibilidade','desc')
        ->get();
  //  var_dump($anu);
        /*$anu2 = Casaofertademanda
            ::join('anuncios', 'anuncios.id', '=', 'casaofertademandas.idoferta')
            ->join('users', 'users.id','=','anuncios.idanunciante')
            ->select('anuncios.*', 'casaofertademandas.graucompatibilidade','casaofertademandas.iddemanda', 'users.name')
            ->where('casaofertademandas.idinteressado','=', Auth::user()->id)
            ->where('anuncios.situacao','=','ativo')
            ->orderby('casaofertademandas.graucompatibilidade','desc')
            ->get();
*/
        $minhademanda = Anuncio::Meusanuncios()->Situacao()->Tipodemanda()->get();


         //  $casou = Casaofertademanda::where('idinteressado','=',Auth::user()->id)->get();

      //  return $anu;
     return view('casaofertademanda.home')->with('anu', $anu,'minhademanda',$minhademanda);
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
     * @param  \App\Casaofertademanda  $casaofertademanda
     * @return \Illuminate\Http\Response
     */
    public function show(Casaofertademanda $casaofertademanda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Casaofertademanda  $casaofertademanda
     * @return \Illuminate\Http\Response
     */
    public function edit(Casaofertademanda $casaofertademanda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Casaofertademanda  $casaofertademanda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Casaofertademanda $casaofertademanda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Casaofertademanda  $casaofertademanda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Casaofertademanda $casaofertademanda)
    {
        //
    }
}
