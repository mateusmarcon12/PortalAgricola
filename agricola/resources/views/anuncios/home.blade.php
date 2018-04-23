@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Anúncios</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        @isset($anu)
                        <div class="table-responsive">
                        <table class="table table table-hover">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Típo</th>
                                <th>Descrição</th>
                                <th>Situação</th>

                                <th>Observação</th>
                                <th>Validade</th>
                                <th>Cadastro</th>
                                <th></th>
                                <th></th>


                            </tr>
                            </thead>
                            <tbody>


                            @foreach($anu as $ticket)

                                <tr>
                                    <td>{{$ticket->titulo}}</td>
                                    <td>{{$ticket->tipoanuncio}}</td>
                                    <td>{{$ticket->descricao}}</td>
                                    <td>{{$ticket->situacao}}</td>

                                    <td>{{$ticket->observacao}}</td>
                                    <td>{{date( 'd/m/Y' , strtotime($ticket->datavalidade))}}</td>
                                    <td>{{date( 'd/m/Y' , strtotime($ticket->created_at))}}</td>
                                    <td> <a href="{{action('AnuncioController@edit',$ticket->id)}}" class="btn btn-primary">Editar</a> </td>
                                    <td> <a href="{{action('AnuncioController@update',$ticket->id)}}" class="btn btn-primary">Inativar</a></td>
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

