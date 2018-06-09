@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Perfil de Usuário</div>

                <div class="card-body">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                        <div class="responsive">

                      
                              <h4><b>Nome: {{ $user->name }}</b></h4>
                               <br>
                            
                                <p>
                                    E-mail:{{ $user->email }}
                                </p>
                              <h5><b>Perfil</b></h5>
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
                                    <h6><b>Endereço</b> </h6>
                                    <p>
                                        Rua {{$end->rua}}, nº {{$end->numero}}, bairro {{$end->bairro}}, cidade {{$end->cidade_descricao}} - {{$end->uf_descricao}}/{{$end->iso}}

                                    </p>
                                    @endforeach
                                @endisset 

                                <div style="clear:both" class="card-header">Fotos do Anunciante</div>
                                                                <br><br>
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="gallery">
                                                @foreach($files as $f)
                                                    <figure class="float-left">
                                                        <img align="center" class="img-responsive rounded" width="400" src="{{ url('storage/'.$f) }}"  alt="Anuncio">
                                                        
                                                    </figure>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                              <div style="clear: both">
                                  <br>
                              <div style="clear:both" class="float-none col-md-12 card-header">Avaliações do Anunciante</div>

                                    <br>
                                    <h5 align="center">Este anunciante é classificado em média como nota: {{$media}}</h5>
                                    <br>
                                    <h5 align="center">Já negociou com este anunciate? Deixe sua avaliação e comentário!</h5>
                                <br>

                              <form method="POST" enctype="multipart/form-data" action="{{ route('avaliacao.gravar', $user->id) }}">
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

                        <br>
                                <div class="table-responsive">
                                    <table class="table table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Avaliador</th>
                                                <th>Nota</th>
                                                <th>Comentario</th>
                                                <th>Data Avaliação</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach($avaliacao as $a)
                                                <tr>
                                                    <td>{{$a->avaliador}}</td>
                                                    <td>{{$a->nota}}</td>
                                                    <td>{{$a->comentario}}</td>
                                                    <td>{{date( 'd/m/Y' , strtotime($a->datapost))}}</td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
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

