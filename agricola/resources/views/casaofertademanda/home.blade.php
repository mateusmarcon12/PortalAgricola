@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                        <form class="form-inline my-2 my-lg-0" method="POST" enctype="multipart/form-data" action="{{ route('casamento.filtrar') }}">
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
                <div class="card-header">Anúncios compatíveis com os seus</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        @isset($anu)
                        <div class="table-responsive">
                            <table id="example" class="table sortable table-hover">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Típo</th>
                                    <th>Descrição</th>
                                    <th>Anunciante</th>
                                    <th>Validade</th>
                                    <th>Meu Anúncio</th>
                                    <th>Grau</th>
                                    <th></th>
                                    <th></th>


                                </tr>
                                </thead>
                                <tbody>


                                @foreach($anu as $ticket)



                                        @if($ticket->idof == Auth::user()->id)

                                            <tr bgcolor="white">

                                            <td>{{$ticket->titulodemanda}}</td>
                                            <td>{{$ticket->demandatipo}}</td>
                                            <td>{{$ticket->demandadescricao}}</td>
                                            <td>{{$ticket->demandadornome}}</td>
                                            <td>{{date( 'd/m/Y' , strtotime($ticket->validadedemanda))}}</td>
                                            <td>{{$ticket->titulooferta}}</td>
                                            <td>{{$ticket->graucompatibilidade}}</td>
                                            <td> <a href="{{action('AnuncioController@show',$ticket->iddemanda)}}" class="btn btn-primary">Ver Mais</a> </td>

                                            </tr>

                                        @else
                                            <tr bgcolor="#e6e6fa">
                                            <td>{{$ticket->titulooferta}}</td>
                                            <td>{{$ticket->ofertatipo}}</td>
                                            <td>{{$ticket->ofertadescricao}}</td>
                                            <td>{{$ticket->ofertantenome}}</td>
                                            <td>{{date( 'd/m/Y' , strtotime($ticket->validadeoferta))}}</td>
                                            <td>{{$ticket->titulodemanda}}</td>
                                            <td>{{$ticket->graucompatibilidade}}</td>
                                            <td> <a href="{{action('AnuncioController@show',$ticket->idoferta)}}" class="btn btn-primary">Ver Mais</a> </td>
                                            </tr>
                                        @endif


                                    <tr>

                                    </tr>

                                @endforeach



                                </tbody>
                            </table>
                             {!!$anu->links()!!}
                            @endisset
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

