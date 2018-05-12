@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Seja Bem Vindo! Faça login ou cadastre-se para explorar mais ferramentas do portal</div>

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
                                    <th>Anunciante</th>
                                    <th>Validade</th>
                                    



                                </tr>
                                </thead>
                                <tbody>


                                @foreach($anu as $ticket)



                                        

                                            <tr>

                                            <td>{{$ticket->titulo}}</td>
                                            <td>{{$ticket->tipoanuncio}}</td>
                                            <td>{{$ticket->descricao}}</td>
                                            <td>{{$ticket->name}}</td>
                                            

                                            <td>{{date( 'd/m/Y' , strtotime($ticket->validade))}}</td>


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