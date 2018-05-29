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
        //dd($deman);
        

        $i=0;
        echo "<script>console.log('minhas demandas');</script>";
        foreach ($deman as $demandas){
            echo "<script>console.log($demandas->id);</script>";
            foreach ($ofer as $ofertas) {
                $grau = 0;
                $verifica = 0;
                $verifica2=0;
                
              //  echo "<script>console.log($ofertas->titulo);</script>";
               // echo "<script>console.log($demandas->titulo);</script>";
                if ($ofertas->titulo == $demandas->titulo) {
                    $grau = $grau + 2;
                    
                }    
                echo "<script>console.log($grau.$ofertas->id);</script>";
             /*   if($ofertas->id == 34){
                    dd($ofertas.' - '.$demandas);
                }*/


                if ($ofertas->classe == $demandas->classe) {
                    $grau = $grau +3;
                    echo "<script>console.log($grau.$ofertas->id);</script>";
                }


                if ($ofertas->tipo == $demandas->tipo) {
                    $grau = $grau + 5;
                    echo "<script>console.log($grau.$ofertas->id);</script>";
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
                    $verifica = Casaofertademanda::where('idoferta', '=', $ofertas->id)->where('iddemanda', '=', $demandas->id)->count();
                    echo "<script>console.log($verifica);</script>";
                    if ($verifica == 0) {
                      //  $verifica2 = Casaofertademanda::where('idoferta', '=', $ofertas->id)->where('iddemanda', '=', $demandas->id)->count();

                        //if($verifica2==0){
                            $casa->save();
                            echo "<script>console.log('novo');</script>";
                        //}
                       /* else{
                            $atualizar = Casaofertademanda::where('idoferta', '=', $ofertas->id)->where('iddemanda', '=', $demandas->id)->first();

                            if ($atualizar->graucompatibilidade < $grau) {
                                $atualizar->graucompatibilidade = $grau;
                                $atualizar->save();
                            }
                        }*/
                    }
                    else{
                            $veri = Casaofertademanda::where('idoferta', '=', $ofertas->id)->where('iddemanda', '=', $demandas->id)->first();

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

        $minhasofertas = Anuncio::Meusanuncios()->Tipooferta()->Situacao()->get();
        $demandasoutros = Anuncio::Anunciante()->Tipodemanda()->Situacao()->get();

        echo "<script>console.log('Minhas ofertas');</script>";

        foreach ($minhasofertas as $md){
            echo "<script>console.log($md->id);</script>";
            foreach ($demandasoutros as $do){
                $g=0;
                if($md->titulo == $do->titulo){
                    $g = 2;
                }
                echo "<script>console.log($g.$do->id);</script>";
                if($md->tipo == $do->tipo ){
                    $g=$g+5;
                }
                echo "<script>console.log($g.$do->id);</script>";
                if($md->classe == $do->classe){
                    $g=$g+3;

                }
                echo "<script>console.log($md->categoria);</script>";
                echo "<script>console.log($g.$do->id);</script>";


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
                       // $vv2 = Casaofertademanda::where('idoferta', '=', $casou->idoferta)->where('iddemanda', '=', $casou->iddemanda)->count();
                      //  if($vv2==0) {
                            $casou->save();
                       // }
                      /*  else{
                            $vv2 = Casaofertademanda::where('idoferta', '=', $casou->idoferta)->where('iddemanda', '=', $casou->iddemanda)->first();
                            if($vv2->graucompatibilidade<$g){
                                $vv2->graucompatibilidade=$g;
                                $vv2->save();
                            }
                        }*/
                    }
                    else{

                        $c = Casaofertademanda::where('idoferta', '=', $casou->idoferta)->where('iddemanda', '=', $casou->iddemanda)->first();


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



    $anu = Casaofertademanda::
        join('anuncios as ofertas', 'ofertas.id', '=', 'casaofertademandas.idoferta')
        ->join('anuncios  as demandas', 'demandas.id', '=','casaofertademandas.iddemanda')
        ->join('users as ofertante', 'ofertante.id', '=','casaofertademandas.idofertante')
        ->join('users as demandador', 'demandador.id', '=','casaofertademandas.iddemandador')
        ->select('ofertas.titulo as titulooferta','ofertas.descricao as ofertadescricao','ofertas.datavalidade as validadeoferta',
            'demandas.titulo as titulodemanda', 'demandas.descricao as demandadescricao','demandas.datavalidade as validadedemanda',
            'demandas.tipoanuncio as demandatipo','ofertas.tipoanuncio as ofertatipo',
            'casaofertademandas.graucompatibilidade',
            'demandador.id as demandadorid', 'ofertante.id as idof',
            'demandador.name as demandadornome','ofertante.name as ofertantenome',
            'casaofertademandas.idoferta as idoferta','casaofertademandas.iddemanda as iddemanda')
        ->where('casaofertademandas.iddemandador','=', Auth::user()->id)
        ->orwhere('casaofertademandas.idofertante','=', Auth::user()->id)
        ->orderby('casaofertademandas.graucompatibilidade','desc')
        ->paginate(25);
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
    
    public function filtrar(Request $request){



        if ($request->tipo){
           if ($request->tipo == 'Oferta'){
                $query = Casaofertademanda::where('casaofertademandas.iddemandador','=', Auth::user()->id)->where('casaofertademandas.idofertante','!=', Auth::user()->id);
                 
            }
           else{
                $query = Casaofertademanda::where('casaofertademandas.idofertante','=', Auth::user()->id)->where('casaofertademandas.iddemandador','!=', Auth::user()->id);

           }
        }
        else{
            $query = Casaofertademanda::where('casaofertademandas.idofertante','=', Auth::user()->id)->orwhere('casaofertademandas.iddemandador','=', Auth::user()->id);
        }


        $query->join('anuncios as ofertas', 'ofertas.id', '=', 'casaofertademandas.idoferta')
        ->join('anuncios  as demandas', 'demandas.id', '=','casaofertademandas.iddemanda')
        ->join('users as ofertante', 'ofertante.id', '=','casaofertademandas.idofertante')
        ->join('users as demandador', 'demandador.id', '=','casaofertademandas.iddemandador')
        ->select('ofertas.titulo as titulooferta','ofertas.descricao as ofertadescricao','ofertas.datavalidade as validadeoferta',
            'demandas.titulo as titulodemanda', 'demandas.descricao as demandadescricao','demandas.datavalidade as validadedemanda',
            'demandas.tipoanuncio as demandatipo','ofertas.tipoanuncio as ofertatipo',
            'casaofertademandas.graucompatibilidade',
            'demandador.id as demandadorid', 'ofertante.id as idof',
            'demandador.name as demandadornome','ofertante.name as ofertantenome',
            'casaofertademandas.idoferta as idoferta','casaofertademandas.iddemanda as iddemanda');

        $anu = $query->orderby('casaofertademandas.graucompatibilidade','desc')->paginate(25);

        $minhademanda = Anuncio::Meusanuncios()->Situacao()->Tipodemanda()->get();

     return view('casaofertademanda.home')->with('anu', $anu,'minhademanda',$minhademanda);
    }



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
