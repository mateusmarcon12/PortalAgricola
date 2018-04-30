@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              
              <a class="navbar-brand" href="#">Filtrar</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Tipo de Anuncio
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('anuncio.ofer') }}">Ofertas</a>
                      <a class="dropdown-item" href="{{ route('anuncio.dem') }}">Demandas</a>
                                         
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                  </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
              </div>
            </nav>
            <div class="card">
                <div class="card-header">Anúncios</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="container">
                



                         @isset($anu)
                        <div class="table-responsive">
                            <table class="table table table-hover">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Típo</th>
                                    <th>Descrição</th>
                                    <th>Anunciante</th>
                                    <th>Validade</th>
                                    <th></th>



                                </tr>
                                </thead>
                                <tbody>


                                @foreach($anu as $ticket)



                                        

                                            <tr>

                                            <td>{{$ticket->titulo}}</td>
                                            <td>{{$ticket->tipoanuncio}}</td>
                                            <td>{{$ticket->descricao}}</td>
                                            <td>{{$ticket->name}}</td>
                                            <td>{{date( 'd/m/Y' , strtotime($ticket->datavalidade))}}</td>
                                            <td> <a href="{{action('AnuncioController@show',$ticket->id)}}" class="btn btn-primary">Ver Mais</a> </td>

                                            </tr>

                                    <tr>

                                    </tr>

                                @endforeach



                                </tbody>
                            </table>
                            @endisset
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

