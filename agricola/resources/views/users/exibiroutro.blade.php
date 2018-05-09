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



                        </div>
                        <br>
                           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

