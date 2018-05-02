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

                      
                              <h3>Nome: {{ Auth::user()->name }} </h3><br>
                            
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
                              <h6>Endereço</h6>
                                @foreach($endereco as $end)
                                <p>
                                    Rua {{$end->rua}}, nº {{$end->numero}}, bairro {{$end->bairro}}, cidade {{$end->cidade_descricao}} - {{$end->uf_descricao}}/{{$end->iso}}

                                </p>
                                @endforeach
                                <h5>Fotos<h5>
                                @foreach($files as $f)
                                    
                                    <img src="{{ url('storage/'.$f) }}" width="95%" alt="Anuncio">
                                @endforeach    

           

                        </div>



                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
