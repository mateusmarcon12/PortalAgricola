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

