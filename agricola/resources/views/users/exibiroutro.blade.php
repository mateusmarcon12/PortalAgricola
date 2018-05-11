@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Perfil de Usuário</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="table-responsive">

                      
                              <h3>Nome: {{ $user->name }}</h3>
                               <br>
                            
                                <p>
                                    E-mail:{{ $user->email }}
                                </p>
                              <h5 x>Perfil</h5>
                                <p>
                                    Sexo: {{ $user->sexo }} <br>
                                    @if ($user->cpf != null)
                                        CPF: {{ $user->cpf }}<br>
                                    @endif
                                    @if ($user->cnpj != null) 
                                        CNPJ: {{ $user->cnpj }}   
                                    @endif
                                </p>
                               

                                @isset($endereco)
                                    @foreach($endereco as $end)
                                    <h6>Endereço </h6>
                                    <p>
                                        Rua {{$end->rua}}, nº {{$end->numero}}, bairro {{$end->bairro}}, cidade {{$end->cidade_descricao}} - {{$end->uf_descricao}}/{{$end->iso}}

                                    </p>
                                    @endforeach
                                @endisset 
                                @empty($endereco)
                                    <h6>Endereço <a href="{{action('EnderecoController@create')}}" class="btn btn-light">Cadastrar Endereço</a></h6>
                                @endempty
                                <h5>Fotos<h5>
                                @foreach($files as $f)
                                    
                                    <img src="{{ url('storage/'.$f) }}" width="95%" alt="Anuncio">
                                @endforeach

                              <div class="card-header">Avaliar Anunciante</div>
                                    <br>
                              <form method="POST" enctype="multipart/form-data" action="{{ route('email.enviar', $user->id) }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="nota" class="col-md-4 col-form-label text-md-right">{{ __('Nota:') }}</label>

                                            <div class="col-md-6">
                                                <label class="btn btn-secondary active"> 1 <input type="radio" name="nota" value="1"></label>
                                                    <label class="btn btn-secondary active"> 2<input type="radio" name="nota" value="2"></label>
                                                        <label class="btn btn-secondary active">  3<input type="radio" name="nota" value="3"></label>
                                                            <label class="btn btn-secondary active"> 4<input type="radio" name="nota" value="4"></label>
                                                                <label class="btn btn-secondary active">  5<input type="radio" name="nota" value="5"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="comentario" class="col-md-4 col-form-label text-md-right">{{ __('Comentário') }}</label>

                                            <div class="col-md-6">
                                                <textarea id="comentario"  class="form-control{{ $errors->has('comentario') ? ' is-invalid' : '' }}" name="comentario" value="{{ old('comentario') }}" required autofocus>  </textarea>

                                                @if ($errors->has('comentario'))
                                                    <span class="invalid-feedback">
                                                <strong>{{ $errors->first('comentario') }}</strong>
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

                               </form>
                        </div>
                        <br>
                           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

