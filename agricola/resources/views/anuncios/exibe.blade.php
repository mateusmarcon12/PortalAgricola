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

                          
                              <h3>Título: {{$anu->titulo}} <a href="{{action('AnuncioController@edit',$anu->id)}}" class="btn btn-light">Editar</a> <a href="{{action('AnuncioController@inativar',$anu->id)}}" class="btn btn-light">Inativar</a></h3><br>
                                <h5>Detalhes</h5>
                                <p>
                                    Descrição: {{$anu->descricao}}<br>
                                    Situacao: {{$anu->situacao}}<br>
                                    Tipo: {{$anu->tipoanuncio}}<br>
                                    Classificação: {{$classificacao->nome}} <br>
                                    Categoria: {{$categoria->nome}}<br>
                                    Observação: {{$anu->observacao}}<br>
                                    Data de Validade: {{date( 'd/m/Y' , strtotime($anu->datavalidade))}}<br>

                                </p>
                              <h5 x>Anunciante</h5>
                                <p>
                                    Nome: {{$user->name}} <br>
                                    E-mail:{{$user->email}} <br>

                                </p>
                              <h5>Endereço</h5>
                                @foreach($ende as $e)
                                <p>
                                    Rua {{$e->rua}}, nº {{$e->numero}}, bairro {{$e->bairro}}, cidade {{$e->cidade_descricao}} - {{$e->cidade_cep}} - {{$e->uf_descricao}} - {{$e->nome}}
                                </p>
                                @endforeach

                            <div style="clear:both" class="card-header">Fotos</div>
                            <div class="col-md-12  justify-content-center ">
                                @foreach($files as $f)

                                    <img class="img-responsive rounded float-left" width="400" src="{{ url('storage/'.$f) }}" width="95%" alt="Anuncio">
                                @endforeach    

                            </div>
                          

                         <br> 
                        </div>
                        <div style="clear:both">
                            <div class="justify-content-center">
                                <div align="center">
                                    <a class="btn btn-light" href="{{ route('fotos.excluiranuncio', $anu->id) }}">
                                        {{ __('Excluir Fotos') }}
                                    </a>
                                </div>
                                <br>
                                <div>
                        <form method="POST" enctype="multipart/form-data" action="{{ route('foto.storeanuncio', $anu) }}">
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
</div>
@endsection

