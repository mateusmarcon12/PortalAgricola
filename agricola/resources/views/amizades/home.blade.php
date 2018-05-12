@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Anunciantes do Portal</div>

                    <div class="card-body">

                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
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

                                            <tr>

                                            <td>{{$ticket->nome}}</td>
                                            <td>{{$ticket->email}}</td>
                                            <td><a href="{{route('usuario.exibeoutro', $ticket->idanunciante)}}" class="btn btn-primary">Ver Mais</a></td>
                                            <td><a href="{{route('amizade.excluir', $ticket->idamizade)}}" class="btn btn-primary">Excluir Amizade</a></td>

                                            </tr>

                                    <tr>

                                    </tr>

                                @endforeach


                                @foreach($amizades2 as $ticket2)

                                    <tr>

                                        <td>{{$ticket2->nome}}</td>
                                        <td>{{$ticket2->email}}</td>
                                        <td><a href="{{route('usuario.exibeoutro', $ticket2->idanunciante)}}" class="btn btn-primary">Ver Mais</a></td>
                                        <td><a href="{{route('amizade.excluir', $ticket2->idamizade)}}" class="btn btn-primary">Excluir Amizade</a></td>

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
@endsection