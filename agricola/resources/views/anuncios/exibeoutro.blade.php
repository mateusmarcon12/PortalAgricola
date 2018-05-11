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
                        <div class="table-responsive">

                       
                              <h3>Título: {{$anu->titulo}}</h3><br>
                                <h5>Detalhes</h5>
                                <p>
                                    Descrição: {{$anu->descricao}}<br>
                                    Tipo: {{$anu->tipoanuncio}}<br>
                                    Classificação: {{$anu->classificacao}} <br>
                                    Categoria: {{$anu->categoria}}<br>
                                    Observação: {{$anu->observacao}}<br>
                                    Data de Validade: {{date( 'd/m/Y' , strtotime($anu->datavalidade))}}<br>
                                    Classificação: {{$anu->classificacao}}<br>
                                </p>
                              <h5 x>Anunciante</h5>
                                <p>
                                    Nome: {{$user->name}} <a href="{{route('usuario.exibeoutro', $anu->idanunciante)}}" class="btn btn-light">Ver Mais</a><br>
                                 
                                    E-mail:{{$user->email}} <br>
                                    

                                </p>
                              <h5>Endereço</h5>
                                @foreach($ende as $e)
                                <p>
                                    Rua {{$e->rua}}, nº {{$e->numero}}, bairro {{$e->bairro}}, cidade {{$e->cidade_descricao}} - {{$e->cidade_cep}} - {{$e->uf_descricao}} - {{$e->nome}}
                                </p>
                                @endforeach

                                <h5>Fotos</h5>



                                @foreach($files as $f)

                                    <img src="{{ url('storage/'.$f) }}" width="95%" alt="Anuncio">
                                @endforeach    

                          
                            <br>
                            <h4><br>Enviar e-mail:</h4>
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
                                        <button type="submit" class="btn btn-light">
                                            {{ __('Enviar') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </form>

                         <br> 
                        </div>
                    
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

