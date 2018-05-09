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
                        <form class="form-inline my-2 my-lg-0" method="POST" enctype="multipart/form-data" action="{{ route('anuncio.filtraranuncio') }}">
                           @csrf
                          <select name="categoria" class="form-control">
                              <option value="">Categoria</option>
                                    @foreach($categorias as $cat)

                                        <option value="{{$cat->id}}"> {{$cat->nome}}<br>
                                        </option>  
                                    @endforeach
                          </select> 
                          <select name="classificacao" class="form-control">
                              <option value="" >Classificação</option>
                                    @foreach($classificacoes as $clas)

                                        <option value="{{$clas->id}}"> {{$clas->nome}}<br>
                                        </option>  
                                    @endforeach
                          </select> 

                          <select name="tipo" class="form-control">
                              <option value="">Tipo</option>
                              <option value="Oferta">Ofertas</option>
                              <option value="Demanda">Demandas</option>
                          </select>  
                          <select name="estado" class="form-control">
                              <option value="">UF</option>
                                    @foreach($estados as $uf)

                                        <option value="{{$uf->uf_codigo}}"> {{$uf->uf_descricao}}<br>
                                        </option>  
                                    @endforeach
                          </select>
                          <input class="form-control mr-sm-2" name="titulo" type="search" placeholder="titulo" aria-label="Search">
                          
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

