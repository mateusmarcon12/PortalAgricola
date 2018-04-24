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

                          @foreach($detanuncio as $anu)
                              <h3>Título: {{$anu->titulo}}</h3><br>
                                <h5>Detalhes:</h5>
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
                                    Nome: {{$anu->anunciante}} <br>
                                    E-mail:{{$anu->email}} <br>

                                </p>
                              <h5>Endereço</h5>
                                <p>
                                    Rua {{$anu->rua}}, nº {{$anu->numero}}, bairro {{$anu->bairro}}, cidade {{$anu->cidade}} - {{$anu->cidade_cep}} - {{$anu->estado}} - {{$anu->pais}}

                                </p>
                          @endforeach



                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

