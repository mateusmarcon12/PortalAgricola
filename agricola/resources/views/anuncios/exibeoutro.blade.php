@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Anúncio</div>

                <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <div class="row">

                            <div class="responsive col-md-6">

                       
                              <h3>Título: {{$anu->titulo}}</h3><br>
                                <h5><b>Detalhes</b></h5>
                                <p>
                                    Descrição: {{$anu->descricao}}<br>
                                    Tipo: {{$anu->tipoanuncio}}<br>
                                    Classificação: {{$classificacao->nome}} <br>
                                    Categoria: {{$categoria->nome}}<br>
                                    Observação: {{$anu->observacao}}<br>
                                    Data de Validade: {{date( 'd/m/Y' , strtotime($anu->datavalidade))}}<br>

                                </p>
                              <h5><b>Anunciante</b></h5>
                                <p>
                                    Nome: {{$user->name}} <a href="{{route('usuario.exibeoutro', $anu->idanunciante)}}" class="btn btn-light">Ver Mais</a><br>
                                 
                                    E-mail:{{$user->email}} <br>
                                    

                                </p>
                              <h5><b>Endereço</b></h5>
                                @foreach($ende as $e)
                                <p>
                                    Rua {{$e->rua}}, nº {{$e->numero}}, bairro {{$e->bairro}}, cidade {{$e->cidade_descricao}} - {{$e->cidade_cep}} - {{$e->uf_descricao}} - {{$e->nome}}
                                </p>
                                @endforeach

                          
                            </div>
                            <div class="col-md-6">
                                <div class="card-header">Fotos</div>
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="gallery">
                                                @foreach($files as $f)
                                                    <figure class="float-left">
                                                        <a target="_blank" class="example-image-link" href="{{ url('storage/'.$f) }}" data-lightbox="example-1"><img align="center" class="img-responsive rounded border-20" height="100" src="{{ url('storage/'.$f) }}" alt="image" /></a>
                                                    </figure>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            <br>
                            </div>
                        </div>
                            @if($anu->situacao == 'ativo')
                                <div class="card-header">Abrir negociação e enviar e-mail</div>
                                <br>
                                <p align="center">Responda este anúncio para iniciar uma negociação, e notificar o anunciante por e-mail.</p>
                                <br>
                                <form method="POST" enctype="multipart/form-data" action="{{ route('email.enviar', $anu->id) }}">
                                @csrf
                                  
                                    <div class="form-group row">
                                        <label for="titulo" class="col-md-4 col-form-label text-md-right">{{ __('Assunto') }}</label>

                                        <div class="col-md-6">
                                            <input id="assunto" type="text" class="form-control{{ $errors->has('assunto') ? ' is-invalid' : '' }}" name="assunto" value="{{ old('assunto') }}" required autofocus>

                                            @if ($errors->has('assunto'))
                                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('assunto') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sugerido" class="col-md-4 col-form-label text-md-right">{{ __('Vincule um dos seus anuncios a negociação') }}</label>

                                        <div class="col-md-6">

                                            <select name="sugerido" id="sugerido" >
                                                    <option value="">nenhum</option>
                                                @foreach($meusanuncios as $manu)

                                                    <option value="{{$manu->id}}"> {{$manu->titulo}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>     
                                    <div class="form-group row">
                                            <label for="mensagem" class="col-md-4 col-form-label text-md-right">{{ __('Mensagem') }}</label>

                                            <div class="col-md-6">
                                                <textarea id="mensagem" maxlength="450" class="form-control{{ $errors->has('mensagem') ? ' is-invalid' : '' }}" name="mensagem" value="{{ old('mensagem') }}" required autofocus>  </textarea>

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
                                                {{ __('Abrir negociação') }}
                                            </button>
                                        </div>
                                    </div>

                                </form>
                                <div class="card-header">Recomendar para um amigo</div>
                                <form method="POST" enctype="multipart/form-data" action="{{ route('recomendacao.guardar', $anu->id) }}">
                                    @csrf
                                    <p align="center">Recomende este anúncio para um de seus amigos que possa interessar-se!</p>
                                    <div class="form-group row">
                                        <br><br><br>
                                        <label for="recomendar" class="col-md-4 col-form-label text-md-right">{{ __('Amigo') }}</label>

                                        <div class="col-md-6">

                                            <select name="recomendado" id="recomendado" >
                                                @foreach($amizades as $ami)

                                                    <option value="{{$ami->idamigo}}"> {{$ami->nome}}</option>

                                                @endforeach
                                                @foreach($amizades2 as $ami2)
                                                    <option value="{{$ami2->idamigo}}"> {{$ami2->nome}}</option>

                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-secondary">
                                                    {{ __('Enviar') }}
                                                </button>
                                        </div>

                                    </div>
                                </form>
                         <br>

                            @else
                                <h4 align="center">Este anúncio está em negociação!</h4>
                            @endif

<div class="card-header"></div><br>
                            <div align="center" class="align-content-center">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                            </div>
                        </div>
                    
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

