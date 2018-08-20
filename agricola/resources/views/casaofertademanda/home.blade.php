@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
              <div class="card-header">Anúncios <a href="{{ url('/') }}" class="btn btn-outline-success my-2 my-sm-0"> Ver mais recentes</a></div>
                <div class="card-body">
                   <form class="form-inline my-2 my-lg-0" method="get" action="{{ URL::to('/relevantes/search') }}">

                     @csrf
                     <select name="tipo" class="form-control">
                      <option value="">Tipo</option>
                      <option value="Oferta">Ofertas</option>
                      <option value="Demanda">Demandas</option>
                  </select>  

                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
              </form>
          </div>            
      </div>                
  </div>        



  <div class="col-md-10">
    <div class="card">
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            @isset($anu)

            <div class="row">
                @foreach($anu as $ticket)

                <div class="col-lg-6 portfolio-item">

                    <div class="card">
                        @if($ticket->idof == Auth::user()->id)
                            <div align="center" style="max-height:100px; max-height: 700px;">
                            
                                @for($i=0;$i<sizeof($imagens);$i++)
                                    @if($imagens[$i]['anuncio'] == $ticket->iddemanda)
                                        @if($imagens[$i]['imagem'] != null)
                                            <img class="card-img-top img-responsive" style="max-height:100px; width: auto;" src="{{ url('storage/'.$imagens[$i]['imagem']) }}">
                                        @else
                                            <img class="card-img-top img-responsive" style="max-height:100px; width: auto;" src="{{ url('storage/erro.jpg')}}">
                                        @endif
                                        @break
                                    @endif
                                @endfor
                            </div>

                            <div class="card-body">
                                <h2 class="card-title" style="color:green; text-transform: uppercase;">
                                    {{$ticket->titulodemanda}}
                                </h2>
                                <div class="row">
                                    <div class="col-md-9">
                                        <p class="card-text">
                                           <b> Tipo: {{$ticket->demandatipo}} </b><br>
                                           Descrição: {{$ticket->demandadescricao}} <br>
                                           Anunciante: {{$ticket->demandadornome}} <br>
                                           Minha oferta: {{$ticket->titulooferta}} <br>
                                           Grau de relevância: {{$ticket->graucompatibilidade}} <br>
                                       </p>
                                    </div>
                                    <div class=" col-md-3">
                                        <a href="{{action('AnuncioController@show',$ticket->iddemanda)}}" class="btn btn-primary"> Ver Mais</a>
                                    </div>
                                </div>        
                           </div>                         

                        @else
                            <div align="center" style="max-height:100px; max-height: 700px;">
                            
                                @for($i=0;$i<sizeof($imagens);$i++)
                                    @if($imagens[$i]['anuncio'] == $ticket->idoferta)
                                        @if($imagens[$i]['imagem'] != null)
                                            <img class="card-img-top img-responsive" style="max-height:100px; width: auto;" src="{{ url('storage/'.$imagens[$i]['imagem']) }}">
                                        @else
                                            <img class="card-img-top img-responsive" style="max-height:100px; width: auto;" src="{{ url('storage/erro.jpg')}}">
                                        @endif
                                        @break
                                    @endif
                                @endfor
                            </div>

                            <div class="card-body ">
                                <h2 class="card-title" style="color:green; text-transform: uppercase;">
                                    {{$ticket->titulooferta}}
                                </h2>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <p class="card-text">
                                               <b> Tipo: {{$ticket->ofertatipo}} </b><br>
                                               Descrição: {{$ticket->ofertadescricao}} <br>
                                               Anunciante: {{$ticket->ofertantenome}} <br>
                                               Minha demanda: {{$ticket->titulodemanda}} <br>
                                               Grau de relevância: {{$ticket->graucompatibilidade}} <br>
                                           </p>
                                        </div>
                                        <div class=" col-md-3">
                                            <a href="{{action('AnuncioController@show',$ticket->idoferta)}}" class="btn btn-primary"> Ver Mais</a>
                                        </div>
                                    </div>        
                           </div>    
                        @endif 

                    </div>
                </div>

                @endforeach
                {{ $anu->appends(Input::get())->links() }}
                @endisset
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

