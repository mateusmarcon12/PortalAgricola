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
                                <th>Titulo</th>
                                <th>Situação</th>
                                <th></th>


                            </tr>
                            </thead>
                            <tbody>

                            @isset($negociacaos1)
                            @foreach($negociacaos1 as $ticket)

                                <tr>
                                    
                                    <td>{{$ticket->idnegociacao}}</td>
                                    <td>{{$ticket->titulo}}</td>
                                    <td>{{$ticket->situacao}}</td>
                                     <td> <a href="{{action('NegociacaoController@show',$ticket->idnegociacao)}}" class="btn btn-primary">Ver mais</a></td>
                                </tr>
                                <tr>

                                </tr>
                            @endforeach
                            @endisset
                            @isset($negociacaos2)
                            @foreach($negociacaos2 as $ticket2)

                                <tr>
                                    
                                    <td>{{$ticket2->idnegociacao}}</td>
                                    
                                    <td></td>
                                    
                                     <td> <a href="{{action('NegociacaoController@show',$ticket2->idnegociacao)}}" class="btn btn-primary">Ver mais</a></td>
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

