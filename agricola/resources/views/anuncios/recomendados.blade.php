@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-10">

            <div class="card">
                <div class="card-header">Anúncios Sugerido por amigo</div>

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


                                @for($i=0;$i<$tamanho;$i++)

                                            <tr>

                                                <td>{{$anu[1]->titulo}}</td>
                                                <td>{{$anu[1][0]->titulo}}</td>
                                                <td>{{$anu[1][0]->titulo}}</td>
                                                <td>{{$anu[1][0]->titulo}}</td>


                                            <td>{{date( 'd/m/Y' , strtotime($anu[$i][0]->validade))}}</td>
                                            <td> <a href="{{action('AnuncioController@show',$ticket->id)}}" class="btn btn-primary">Ver Mais</a> </td>

                                            </tr>

                                    <tr>

                                    </tr>

                                @endfor



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

