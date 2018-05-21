@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Suas Negociações</div>

                <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        
                        <div class="table-responsive">
                        <table class="table table table-hover">
                            <thead>
                            <tr>
                                <th>Negociação</th>
                                <th>Negociante</th>
                                <th>Situação</th>
                                <th>Resolução</th>
                                <th></th>


                            </tr>
                            </thead>
                            <tbody>

                            @isset($negociacaos1)
                            @foreach($negociacaos1 as $ticket)

                                <tr>
                                    
                                    <td>{{$ticket->id}}</td>
                                    <td></td>
                                    <td>{{$ticket->situacao}}</td>
                                    <td>{{$ticket->resultado}}</td>
                                     <td> <a href="{{action('NegociacaoController@show',$ticket->id)}}" class="btn btn-primary">Ver mais</a></td>
                                </tr>
                                <tr>

                                </tr>
                            @endforeach
                            @endisset
                            @isset($negociacaos2)
                            @foreach($negociacaos2 as $ticket2)

                                <tr>
                                    
                                    <td>{{$ticket->id}}</td>
                                    <td></td>
                                    <td>{{$ticket->situacao}}</td>
                                    <td>{{$ticket->resultado}}</td>
                                     <td> <a href="{{action('NegociacaoController@show',$ticket2->id)}}" class="btn btn-primary">Ver mais</a></td>
                                </tr>
                                <tr>

                                </tr>
                            @endforeach
                            @endisset

                            </tbody>
                        </table>
                       
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

