@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Negociação {{$neg->id}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div>
                            @isset($anuncio1)
                            <div>
                                Anuncio:{{$anuncio1->titulo}}<br>
                                Descrição:{{$anuncio1->descricao}} <td> <a href="{{action('AnuncioController@show',$anuncio1->id)}}" class="btn btn-secondary">Ver Mais</a>
                            </div>
                            @endisset
                            <br>
                            @isset($anuncio2)
                            <div>
                                Anuncio:{{$anuncio2->titulo}}<br>
                                Descrição:{{$anuncio2->descricao}} <td> <a href="{{action('AnuncioController@show',$anuncio2->id)}}" class="btn btn-secondary">Ver Mais</a>
                            </div>
                            @endisset
                            
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

