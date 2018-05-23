@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-10">

            <div class="card">
                <div class="card-header">Anúncios Sugeridos por Amigos</div>

                <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                <div class="container">

                     @isset($recomendacoes)
                        <div class="table-responsive">
                            <table class="table table table-hover">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Anunciante</th>
                                    <th>E-mail</th>
                                    <th>Validade</th>
                                    <th></th>
                                    <th></th>



                                </tr>
                                </thead>
                                <tbody>


                                @foreach($recomendacoes as $anu)

                                            <tr>

                                                <td>{{$anu->titulo}}</td>
                                                <td>{{$anu->nome}}</td>
                                                <td>{{$anu->email}}</td>
                                               


                                            <td>{{date( 'd/m/Y' , strtotime($anu->datavalidade))}}</td>
                                            <td> <a href="{{action('AnuncioController@show',$anu->idanuncio)}}" class="btn btn-primary">Ver Mais</a> </td>
                                            <td> <a href="{{action('RecomendacaoController@excluir',$anu->idrecomendacao)}}" class="btn btn-primary">Excluir</a> </td>

                                            </tr>

                                    <tr>

                                    </tr>

                                @endforeach



                                </tbody>
                            </table>
                            @endisset
                        </div>

                    <div align="center" class="align-content-center">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

