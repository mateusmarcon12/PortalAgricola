@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
<!--
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Tipo de Anuncio
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('anuncio.ofer') }}">Ofertas</a>
                              <a class="dropdown-item" href="{{ route('anuncio.dem') }}">Demandas</a>
                                                 
                            </div>
                          </li>
                        </ul>
-->
                        <form class="form-inline my-2 my-lg-0">
                          <select class="form-control">
                              <option>Categorias</option>
                              <option>Ofertas</option>
                              <option>Demandas</option>
                          </select> 
                          <select class="form-control">
                              <option>Tipos</option>
                              <option>Ofertas</option>
                              <option>Demandas</option>
                          </select> 

                          <select class="form-control">
                              <option>Classificações</option>
                              <option></option>
                              <option>Demandas</option>
                          </select>  
                          <select class="form-control">
                              <option>Todos UF</option>
                              <option>Ofertas</option>
                              <option>Demandas</option>
                          </select>
                          <input class="form-control mr-sm-2" type="search" placeholder="titulo" aria-label="Search">
                          
                          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
                        </form>
                </div>            
            </div>                
        </div>




        <div class="col-md-10">

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

