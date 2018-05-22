@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cadastrar '.$nomeanuncio) }}</div>

                    <div class="card-body">

                        <form method="POST" enctype="multipart/form-data" action="{{ route($tipoanuncio) }}">
                            @csrf
                            <h6>Dados {{$nomeanuncio}}</h6>
                            <div class="form-group row">
                                <label for="titulo" class="col-md-4 col-form-label text-md-right">{{ __('Título') }}</label>

                                <div class="col-md-6">
                                    <input id="titulo" type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" value="{{ old('titulo') }}" required autofocus>

                                    @if ($errors->has('titulo'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('titulo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Imagem" class="col-md-4 col-form-label text-md-right">{{ __('Imagem') }}</label>

                                <div class="col-md-6">
                                    <input type="file" name="images" id="file">

                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                                <div class="col-md-6">
                                    <textarea id="descricao" rows="3" type="textarea" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" value="{{ old('descricao') }}" required autofocus>
                                    </textarea>
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
                                        <option value=""></option>
                                    @foreach($classificacoes as $class)
                                
                                        <option value="{{$class->id}}"> {{$class->nome}}</option>

                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
                                <br>
                                <div class="col-md-6">

                                    <select name="categoria" id="categoria">

                                    </select>    
                                    <!-- @foreach($categorias as $cat)

                                        <input type="radio" name="categoria" value="{{$cat->id}}"> {{$cat->nome}}<br>

                                    @endforeach -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="quantidade" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade') }}</label>

                                <div class="col-md-3">
                                    <input id="quantidade" type="number" class="form-control{{ $errors->has('quantidade') ? ' is-invalid' : '' }}" name="quantidade" value="{{ old('quantidade') }}" required autofocus>

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
                                            <option value="un">Unidade</option>
                                            <option value="kg">KG</option>
                                            <option value="kg">L</option>
                                            <option value="m²">M²</option>
                                            <option value="sacas">sacas</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="observacao" class="col-md-4 col-form-label text-md-right">{{ __('Observações') }}</label>

                                <div class="col-md-6">
                                    <textarea id="observacao" rows="3" type="textarea" class="form-control{{ $errors->has('observacao') ? ' is-invalid' : '' }}" name="observacao" value="{{ old('observacao') }}" required autofocus>
                                    </textarea>
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
                                    <input id="datavalidade" type="date" class="form-control{{ $errors->has('datavalidade') ? ' is-invalid' : '' }}" name="datavalidade" value="{{ old('datavalidade') }}" required autofocus>

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
                                <label for="estado" class="col-md-4 col-form-label text-md-right" >{{ __('Estado') }}</label>

                                <div class="col-md-6">
                                    <select name="estado" id="ufSelect" onchange="verificaruf()">
                                            <option value="">
                                        @foreach($estados as $rows)
                                            <option value="{{$rows->uf_codigo}}">{{$rows->uf_descricao}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cidade" class="col-md-4 col-form-label text-md-right">{{ __('CEP - Cidade') }}</label>

                                <div class="col-md-6">
                                    <select name="cidade" id="cidade">
                                        <!--@foreach($result as $row)
                                            <option value="{{$row->cidade_codigo}}">{{$row->cidade_cep}} - {{$row->cidade_descricao}} </option>
                                        @endforeach -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bairro" class="col-md-4 col-form-label text-md-right">{{ __('Bairro') }}</label>

                                <div class="col-md-6">
                                    <input id="bairro" type="text" class="form-control{{ $errors->has('bairro') ? ' is-invalid' : '' }}" name="bairro" value="{{ old('bairro') }}" required autofocus>

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
                                    <input id="rua" type="text" class="form-control{{ $errors->has('rua') ? ' is-invalid' : '' }}" name="rua" value="{{ old('rua') }}" required autofocus>

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
                                    <input id="titulo" type="text" class="form-control{{ $errors->has('numero') ? ' is-invalid' : '' }}" name="numero" value="{{ old('numero') }}" required autofocus>

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
                                    <input id="endobservacao" type="text" class="form-control{{ $errors->has('endobservacao') ? ' is-invalid' : '' }}" name="endobservacao" value="{{ old('endobservacao') }}" required autofocus>

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


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
function verificarclassificacao(){
    var x = document.getElementById("classificacaoSelect").value;
    var ar = <?php echo json_encode($categorias,JSON_PRETTY_PRINT) ?>;
    $("#categoria").empty();
    for (var i = 0; i < ar.length; i++) {
    
        if(x==ar[i].idclassificacao){
            $('#categoria').append('<option name="categoria" value="' + ar[i].id + '">' + ar[i].nome + '</option>');
        
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
           console.log(cidades[i]); 
        }

    }
}
</script>