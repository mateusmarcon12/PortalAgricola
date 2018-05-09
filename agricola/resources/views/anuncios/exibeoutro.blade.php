@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Anúncio</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
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
                                    Nome: {{$user->name}} <a href="{{route('usuario.exibeoutro',$anu)}}" class="btn btn-light">Ver Mais</a><br>
                                 
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
                        </div>
                    
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

