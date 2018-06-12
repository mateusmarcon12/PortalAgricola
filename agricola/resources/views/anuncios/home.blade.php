

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                    <form class="form-inline my-2 my-lg-0" method="POST" enctype="multipart/form-data" action="{{ route('anuncio.filtrarmeus') }}">
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
                        <select name="situacao" class="form-control">
                            <option value="">Situação</option>
                            <option value="Ativo"> Ativo</option>
                            <option value="Inativo"> Inativo </option>
                            <option value="negociacao"> Em Negociação</option>

                        </select>
                        <input class="form-control mr-sm-2" name="titulo" type="search" placeholder="titulo" aria-label="Search">

                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Meus Anúncios</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        @isset($anu)
                        <div class="table-responsive">
                        <input class="form-control" id="myInput" type="text" placeholder="Pesquisar..">
                        <table id="example" class="table sortable table-hover">

                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Típo</th>
                                <th>Situação</th>

                                <th>Validade</th>
                                <th>Cadastro</th>
                                <th></th>
                                <th></th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody id="myTable">


                            @foreach($anu as $ticket)

                                          @if($ticket->tipoanuncio=='Oferta')
                                           <tr bgcolor="#98FB98">
                                          @else
                                            <tr bgcolor="#00FF7F">
                                          @endif
                               
                                    <td>{{$ticket->titulo}}</td>
                                    <td>{{$ticket->tipoanuncio}}</td>
                                    <td>{{$ticket->situacao}}</td>

                                    <td>{{date( 'd/m/Y' , strtotime($ticket->datavalidade))}}</td>
                                    <td>{{date( 'd/m/Y' , strtotime($ticket->created_at))}}</td>
                                    <td> <a href="{{action('AnuncioController@show',$ticket->id)}}" class="btn btn-primary">Detalhes</a></td>
                                    <td> <a href="{{action('AnuncioController@edit',$ticket->id)}}" class="btn btn-primary">Editar</a> </td>
                                    @if(($ticket->situacao != 'inativo') && ($ticket->situacao != 'negociacao'))
                                    <td> <a href="{{action('AnuncioController@inativar',$ticket->id)}}" class="btn btn-primary">Inativar</a></td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
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

