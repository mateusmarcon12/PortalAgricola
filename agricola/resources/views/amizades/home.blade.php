@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="card-header">Solicitações de amizade pendentes</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Anunciante</th>
                                        <th>E-mail</th>
                                        <th></th>
                                        <th></th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($solicitacoes as $soli)
                                        <tr>
                                            <td>{{$soli->name}}</td>
                                            <td>{{$soli->email}}</td>
                                            <td><a href="{{route('solicitacao.aceitar', $soli->idsolicitacao)}}" class="btn btn-primary">Aceitar </a></td>
                                            <td><a href="{{route('solicitacao.excluir', $soli->idsolicitacao)}}" class="btn btn-primary">Recusar</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    <div class="card-header">Meus amigos</div>
                        <div class="col-md-12">

                            <div class="card">

                                <div class="card-body">

                                    <form class="form-inline my-2 my-lg-0" method="get" action="{{ URL::to('/amizades/filtrar') }}">
                                        @csrf

                                        <input class="form-control mr-sm-2" name="nome" type="search" placeholder="Nome" aria-label="Search">
                                        <input class="form-control mr-sm-2" name="email" type="email" placeholder="E-mail" aria-label="Search">

                                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            @isset($amizades)
                            <div class="table-responsive">
                                <table class="table table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Anunciante</th>
                                        <th>E-mail</th>
                                        <th></th>
                                        <th></th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($amizades as $ticket)
                                        @if($ticket->idsolicitado != Auth::user()->id)
                                            <tr>

                                                <td>{{$ticket->namesolicitado}}</td>
                                                <td>{{$ticket->emailsolicitado}}</td>
                                                <td><a href="{{route('usuario.exibeoutro', $ticket->idsolicitado)}}" class="btn btn-primary">Ver Mais</a></td>
                                                <td><a href="{{route('amizade.excluir', $ticket->idamizade)}}" class="btn btn-primary">Excluir Amizade</a></td>

                                            </tr>

                                            <tr>

                                            </tr>
                                        @else
                                            <tr>

                                                <td>{{$ticket->namesolicitante}}</td>
                                                <td>{{$ticket->emailsolicitante}}</td>
                                                <td><a href="{{route('usuario.exibeoutro', $ticket->idsolicitante)}}" class="btn btn-primary">Ver Mais</a></td>
                                                <td><a href="{{route('amizade.excluir', $ticket->idamizade)}}" class="btn btn-primary">Excluir Amizade</a></td>

                                            </tr>

                                            <tr>

                                            </tr>
                                        @endif
                                    @endforeach

                                    </tbody>
                                </table>
                                @endisset

                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection