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

                      
                              <h3>Nome: {{ Auth::user()->name }} <a href="{{action('UserController@edit', Auth::user()->id)}}" class="btn btn-light">Editar</a>
                                  <a class="btn btn-light" href="{{ route('password.request') }}">
                                    {{ __('Alterar Senha') }}
                                </a></h3>
                               <br>
                            
                                <p>
                                    E-mail:{{ Auth::user()->email }}
                                </p>
                              <h5 x>Perfil</h5>
                                <p>
                                    Sexo: {{ Auth::user()->sexo }} <br>
                                    @if (Auth::user()->cpf != null)
                                        CPF: {{ Auth::user()->cpf }}<br>
                                    @endif
                                    @if (Auth::user()->cnpj != null) 
                                        CNPJ: {{ Auth::user()->cnpj }}   
                                    @endif
                                </p>
                               

                                @isset($endereco)
                                    @foreach($endereco as $end)
                                    <h6>Endereço <a href="{{action('EnderecoController@edit', $end)}}" class="btn btn-light">Editar Endereço</a></h6>
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



                        </div>
                        <br>
                        <form method="POST" enctype="multipart/form-data" action="{{ route('foto.store') }}">
                            @csrf
                            <div class="row justify-content-center">    
                            <div class="form-group row">
                                <label for="Imagem" class="col-md-4 col-form-label text-md-right">{{ __('Adicionar imagem') }}</label>

                                <div class="col-md-5">
                               <input type="file" name="images" id="file">

                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-5 offset-md-4">
                                    <button type="submit" class="btn btn-light">
                                        {{ __('Salvar') }}
                                    </button>
                                </div>
                            </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

