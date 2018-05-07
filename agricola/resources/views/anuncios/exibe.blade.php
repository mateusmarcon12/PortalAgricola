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
                              <h3>Título: {{$anu->titulo}} <a href="{{action('AnuncioController@edit',$anu->id)}}" class="btn btn-light">Editar</a> <a href="{{action('AnuncioController@inativar',$anu->id)}}" class="btn btn-light">Inativar</a></h3><br>
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
                                    Nome: {{$anu->anunciante}} <br>
                                    E-mail:{{$anu->email}} <br>

                                </p>
                              <h5>Endereço</h5>
                                <p>
                                    Rua {{$anu->rua}}, nº {{$anu->numero}}, bairro {{$anu->bairro}}, cidade {{$anu->cidade}} - {{$anu->cidade_cep}} - {{$anu->estado}} - {{$anu->pais}}

                                </p>


                                <h5>Fotos</h5>



                                @foreach($files as $f)

                                    <img src="{{ url('storage/'.$f) }}" width="95%" alt="Anuncio">
                                @endforeach    

                          
                          @endforeach

                         <br> 
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{ route('foto.store') }}">
                            @csrf
                            <div class="row justify-content-center">
                            <div class="form-group row">
                                <label for="Imagem" class="col-md-4 col-form-label text-md-right">{{ __('Adicionar imagem') }}</label>

                                <div class="col-md-6">
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
                        </div>
                        </form>


                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

