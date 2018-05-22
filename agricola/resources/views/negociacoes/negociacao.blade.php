@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Negociação {{$neg->id}}</div>

                <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        <div>
                            @isset($anuncio1)
                            <div>
                                <b>Anuncio:</b> {{$anuncio1->titulo}}<br>
                                <b>Descrição:</b> {{$anuncio1->descricao}} <td> <a href="{{action('AnuncioController@show',$anuncio1->id)}}" class="btn btn-secondary">Ver Mais</a>
                            </div>
                            @endisset
                            <br>
                            @isset($anuncio2)
                            <div>
                                <b>Anuncio:</b> {{$anuncio2->titulo}}<br>
                                <b>Descrição:</b> {{$anuncio2->descricao}} <td> <a href="{{action('AnuncioController@show',$anuncio2->id)}}" class="btn btn-secondary">Ver Mais</a>
                            </div>
                            @endisset
                            <br>
                        </div>
                        <div class="card-header">Mensagens</div>
                        <br>
                        <div>
                        @isset($mensagem)
                            <div class="col-md-12 justify-content-center">
                                @foreach($mensagem as $c)
                                    <div style="clear: both">
                                        @if($c->idremetente == Auth::user()->id)
                                            <div class="col-md-6 float-right" align="justify">
                                               <i> Mensagem de: {{ $c->name }}</i>
                                        @else
                                           <div class="col-md-6 float-left" align="justify">
                                               <i> Mensagem de: {{ $c->name }}</i>

                                        @endif
                                               <p>{{$c->mensagem}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endisset
                        </div>
                        <div style="clear:both;">
                            <br>
                        
                        <div style="clear:both;">
                            <br>
                        @if($neg->situacao == 'ativa')
                        <div class="card-header">Adicionar mensagem</div>
                        <br>
                            <form method="POST" enctype="multipart/form-data" action="{{ route('negociacao.store', $neg->id) }}">
                            @csrf
                                
                                <div class="form-group row">
                                        <label for="mensagem" class="col-md-4 col-form-label text-md-right">{{ __('Mensagem') }}</label>

                                        <div class="col-md-6">
                                            <textarea id="mensagem"  class="form-control{{ $errors->has('mensagem') ? ' is-invalid' : '' }}" name="mensagem" value="{{ old('mensagem') }}" required autofocus>  </textarea>

                                            @if ($errors->has('mensagem'))
                                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('mensagem') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-secondary">
                                            {{ __('Enviar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        
                        <div class="card-header">Finalizar negociação</div>
                        <br>
                            <form method="POST" enctype="multipart/form-data" action="{{ route('negociacao.finalizar', $neg->id) }}">
                            @csrf
                              
                                <div class="form-group row">
                                    <label for="titulo" class="col-md-4 col-form-label text-md-right">{{ __('Resultado da negociação:') }}</label>

                                    <div class="col-md-6">
                                                <label class="btn btn-secondary active"> Sucesso <input type="radio" name="nota" value="Sucesso" checked=""></label>
                                                    <label class="btn btn-secondary active"> Insucesso<input type="radio" name="nota" value="Insucesso"></label>
                                                
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-secondary">
                                            {{ __('Salvar') }}
                                        </button>
                                    </div>
                                </div>
                                <i>Marcando a opção sucesso, os anuncios serão inativados. Marcando a opção insucesso os anúncios serão reativados e exibidos para os demais usuários</i>
                            </form>
                        @else
                            <h3 align="center">Negociação Finalizada</h3>
                            <h4 align="center">
                                Resolução:
                                @if($neg->resultado == 'sucesso')
                                    Sucesso
                                @else
                                    Insucesso
                                @endif
                            </h4>
                        @endif    
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

