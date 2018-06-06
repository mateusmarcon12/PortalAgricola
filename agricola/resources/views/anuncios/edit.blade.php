@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Anuncios</div>

                    <div class="card-body">


                        <form method="post" enctype="multipart/form-data" action="{{route('upd',$detanuncio->id)}}">
                            @csrf
                        <h6>Dados  </h6>

                            <div class="form-group row">
                                <label for="titulo" class="col-md-4 col-form-label text-md-right">{{ __('Título') }}</label>

                                <div class="col-md-6">
                                    <input id="titulo" type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" value="{{ $detanuncio->titulo }}" required autofocus>

                                    @if ($errors->has('titulo'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('titulo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Situação') }}</label>
                                <br>
                                <div class="col-md-6">

                                        @if($detanuncio->situacao == 'ativo')
                                            <input type="radio" name="situacao" value="ativo" checked> Ativo
                                            <input type="radio" name="situacao" value="inativo"> Inativo<br>
                                        @else
                                            <input type="radio" name="situacao" value="inativo" checked> Inativo
                                            <input type="radio" name="situacao" value="ativo"> Ativo<br>
                                        @endif

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                                <div class="col-md-6">
                                    <textarea id="descricao" rows="3" type="textarea" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" value="{{ $detanuncio->descricao }}" autofocus>{{ $detanuncio->descricao }}</textarea>
                                    @if ($errors->has('descricao'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="classificacao" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
<br>
                                <div class="col-md-6">

                                     <select name="tipo" id="classificacaoSelect" onchange="verificarclassificacao()" >
                                       
                                    @foreach($classificacoes as $class)
                                        @if($detanuncio->tipo == $class->id)
                                            <option value="{{$class->id}}" selected=""> {{$class->nome}}</option>
                                        @else
                                            <option value="{{$class->id}}"> {{$class->nome}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
<br>
                                <div class="col-md-6">

                                    <select name="classe" id="categoria">
                                       
                                        @foreach($categorias as $cat)
                                            @if($cat->id == $detanuncio->classe)
                                                <option value="{{$cat->id}}" selected=>{{$cat->nome}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="quantidade" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade') }}</label>

                                <div class="col-md-3">


                                    <input id="quantidade" type="number" class="form-control{{ $errors->has('quantidade') ? ' is-invalid' : '' }}" name="quantidade" value="{{ $detanuncio->quantidade }}" required autofocus>

                                    @if ($errors->has('quantidade'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('quantidade') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="unidademedida" class="col-md-4 col-form-label text-md-right">{{ __('Unidade de Medida') }}</label>

                                <div class="col-md-6">
                                    <select name="unidademedida">
                                            <option value="{{$detanuncio->unidademedida}}" selected>{{$detanuncio->unidademedida}}</option>
                                            <option value="un">Un</option>
                                            <option value="kg">kg</option>
                                            <option value="kg">l</option>
                                            <option value="m²">m²</option>
                                            <option value="m³">m³</option>
                                            <option value="sacas">Sacas</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="observacao" class="col-md-4 col-form-label text-md-right">{{ __('Observações') }}</label>

                                <div class="col-md-6">
                                    <textarea id="observacao" rows="3" type="textarea" class="form-control{{ $errors->has('observacao') ? ' is-invalid' : '' }}" name="observacao" value="{{ $detanuncio->observacao }}" autofocus>{{ $detanuncio->observacao  }}</textarea>
                                    @if ($errors->has('observacao'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('observacao') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="datavalidade" class="col-md-4 col-form-label text-md-right">{{ __('Validade Anúncio') }}</label>

                                <div class="col-md-4">
                                    <input id="datavalidade" type="date" class="form-control{{ $errors->has('datavalidade') ? ' is-invalid' : '' }}" name="datavalidade" value="{{ $detanuncio->datavalidade  }}" required autofocus>

                                    @if ($errors->has('datavalidade'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('datavalidade') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <h6>Endereço</h6>
                            <div class="form-group row">
                                <label for="pais" class="col-md-4 col-form-label text-md-right">{{ __('Pais') }}</label>

                                <div class="col-md-6">
                                    <select name="pais">
                                        <option value="76">Brasil</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                                <div class="col-md-6">
                                    <select name="estado" id="ufSelect" onchange="verificaruf()">

                                        @foreach($estados as $rows)
                                            @if($rows->uf_codigo == $endereco->iduf)
                                            <option value="{{$rows->uf_codigo}}" selected>{{$rows->uf_descricao}}</option>
                                            @else
                                                <option value="{{$rows->uf_codigo}}">{{$rows->uf_descricao}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cidade" class="col-md-4 col-form-label text-md-right">{{ __('CEP - Cidade') }}</label>

                                <div class="col-md-6">
                                    <select name="cidade" id="cidade">
                                        <!--@foreach($result as $row)
                                            @if($row->cidade_codigo==$endereco->idcidade)
                                                <option value="{{$row->cidade_codigo}}" selected>{{$row->cidade_cep}} - {{$row->cidade_descricao}} </option>
                                            @else
                                                <option value="{{$row->cidade_codigo}}">{{$row->cidade_cep}} - {{$row->cidade_descricao}} </option>
                                            @endif
                                        @endforeach -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bairro" class="col-md-4 col-form-label text-md-right">{{ __('Bairro') }}</label>

                                <div class="col-md-6">
                                    <input id="bairro" type="text" class="form-control{{ $errors->has('bairro') ? ' is-invalid' : '' }}" name="bairro" value="{{ $endereco->bairro }}" required autofocus>

                                    @if ($errors->has('bairro'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('bairro') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rua" class="col-md-4 col-form-label text-md-right">{{ __('Rua') }}</label>

                                <div class="col-md-6">
                                    <input id="rua" type="text" class="form-control{{ $errors->has('rua') ? ' is-invalid' : '' }}" name="rua" value="{{ $endereco->rua }}" required autofocus>

                                    @if ($errors->has('rua'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('rua') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="numero" class="col-md-4 col-form-label text-md-right">{{ __('Número') }}</label>

                                <div class="col-md-6">
                                    <input id="titulo" type="text" class="form-control{{ $errors->has('numero') ? ' is-invalid' : '' }}" name="numero" value="{{ $endereco->numero }}" required autofocus>

                                    @if ($errors->has('numero'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('numero') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="endobservacao" class="col-md-4 col-form-label text-md-right">{{ __('Observação sobre o Endereço') }}</label>

                                <div class="col-md-6">
                                    <input id="endobservacao" type="text" class="form-control{{ $errors->has('endobservacao') ? ' is-invalid' : '' }}" name="endobservacao" value="{{ $endereco->observacao }}" required autofocus>

                                    @if ($errors->has('endobservacao'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('endobservacao') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Salvar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div align="center" class="align-content-center">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
   window.onload = function(){
        var x = document.getElementById("classificacaoSelect").value;
        var ar = <?php echo json_encode($categorias,JSON_PRETTY_PRINT) ?>;
        //$("#categoria").empty();
        for (var i = 0; i < ar.length; i++) {
            if(x==ar[i].idclassificacao){
            $('#categoria').append('<option name="categoria" value="' + ar[i].id + '">' + ar[i].nome + '</option>');
        
            }

        }


        var uf = document.getElementById("ufSelect").value;
        var cidades = <?php echo json_encode($result,JSON_PRETTY_PRINT) ?>;
        var endereco = <?php echo json_encode($endereco,JSON_PRETTY_PRINT) ?>;
        
       // $("#cidade").empty();
        for (var i = 0; i < cidades.length; i++) {
            
            if(uf==cidades[i].uf_codigo){
            
                
                if(endereco.idcidade == cidades[i].cidade_codigo){
                    $('#cidade').append('<option selected name="cidade" value="' + cidades[i].cidade_codigo + '">' +  cidades[i].cidade_descricao +' CEP: '+ cidades[i].cidade_cep+ '</option>');

                }
                else{
                    $('#cidade').append('<option name="cidade" value="' + cidades[i].cidade_codigo + '">' +  cidades[i].cidade_descricao +' CEP: '+ cidades[i].cidade_cep+ '</option>');
                }

               //console.log(cidades[i]); 
            }   
        }

    }

    function verificarclassificacao(){
        var x = document.getElementById("classificacaoSelect").value;
        var ar = <?php echo json_encode($categorias,JSON_PRETTY_PRINT) ?>;
        $("#categoria").empty();
        //$("#cidade").empty();
        for (var i = 0; i < ar.length; i++) {
        
            if(x==ar[i].idclassificacao){
                
                $('#categoria').append('<option value="' + ar[i].id + '">' + ar[i].nome + '</option>');
            
            }

        }
    }

    function verificaruf(){
        var x = document.getElementById("ufSelect").value;
        var cidades = <?php echo json_encode($result,JSON_PRETTY_PRINT) ?>;
        $("#cidade").empty();
        for (var i = 0; i < cidades.length; i++) {

            if(x==cidades[i].uf_codigo){
               $('#cidade').append('<option name="cidade" value="' + cidades[i].cidade_codigo + '">' + cidades[i].cidade_descricao +' CEP: '+ cidades[i].cidade_cep+ '</option>');

            }

        }
    }

</script>