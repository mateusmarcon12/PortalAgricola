

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Perfil de Usuário</div>

                <div class="card-body">
                        <div class="table-responsive">

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                              <h4><b> {{ Auth::user()->name }} </b><a href="{{action('UserController@edit', Auth::user()->id)}}" class="btn btn-light">Editar</a>
                                  <a class="btn btn-light" href="{{ route('usuario.alterarsenha') }}">
                                    {{ __('Alterar Senha') }}
                                </a></h4>
                               <br>
                            <h5><b>Perfil</b></h5>
                                <p>
                                    E-mail: {{ Auth::user()->email }}
                                </p>
                              
                                <p>
                                    Sexo: {{ Auth::user()->sexo }} <br>
                                    @if (Auth::user()->cpf != null)
                                        CPF: {{ Auth::user()->cpf }}<br>
                                    @endif
                                    @if (Auth::user()->cnpj != null) 
                                        CNPJ: {{ Auth::user()->cnpj }}   
                                    @endif
                                    Telefone: {{Auth::user()->telefone}} <br>
                                    Celular: {{Auth::user()->celular}}
                                </p>
                               

                                @isset($endereco)
                                    @foreach($endereco as $end)
                                    <h5><b>Endereço</b> <a href="{{action('EnderecoController@edit', $end)}}" class="btn btn-light">Editar Endereço</a></h5>
                                    <p>
                                        Rua {{$end->rua}}, nº {{$end->numero}}, bairro {{$end->bairro}}, cidade {{$end->cidade_descricao}} - {{$end->uf_descricao}}/{{$end->iso}}

                                    </p>
                                    @endforeach
                                @endisset 
                                @empty($endereco)
                                    <h5>Endereço  <a href="{{action('EnderecoController@create')}}" class="btn btn-light">Cadastrar Endereço</a></h5>
                                @endempty
                                <div style="clear:both" class="card-header">Fotos</div>
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
                        </div>
                        <br>
                        <div style="clear:both">
                            <div class="justify-content-center">
                                <div align="center">
                                    <a class="btn btn-light" href="{{ route('fotos.excluir',Auth::user()->id) }}">
                                        {{ __('Excluir Fotos') }}
                                    </a>
                                </div>
                                <br>
                            </div>
                        </div>

                    <div class="table-responsive">
                    <div style="clear:both" class="container">
                        <div class="card-body">
                                <form method="POST" enctype="multipart/form-data" action="{{ route('foto.store') }}">
                                    @csrf


                                    <div class="form-group row">
                                        <label for="Imagem" class="col-md-4 col-form-label text-md-right">{{ __('Adicionar imagem') }}</label>

                                        <div class="col-md-5">
                                             <input type="file" name="images" id="file">

                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-light">
                                                {{ __('Salvar') }}
                                            </button>
                                        </div>
                                    </div>


                                </form>
                        </div>
                    </div>
                        </div>
                        <div class="card-header"></div><br>
                 <br>
                 <h5 align="center">Deseja inativar sua conta no portal? <a href="{{route('usuario.inativar', Auth::user()->id)}}" class="btn btn-danger">Inativar</a></h5>
                <br>
                            <div class="card-header"></div><br>
                            <br>
                <div align="center" class="align-content-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                </div>

                <br>
                </div>
<!-- testes de galerias-->


            </div>
        </div>
    </div>
</div>
@endsection
