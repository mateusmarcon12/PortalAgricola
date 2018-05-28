@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">Editar Endereço  </div>
                  @foreach($ende as $end)

                        <form method="POST" enctype="multipart/form-data" action="{{route('end.update',$end->id)}}">
                            @csrf


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
                                    <select id="ufSelect" onchange="verificaruf()" name="estado">

                                        @foreach($estados as $rows)
                                            @if($rows->uf_codigo == $end->iduf)
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
                                    <select id="cidade" name="cidade">

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bairro" class="col-md-4 col-form-label text-md-right">{{ __('Bairro') }}</label>

                                <div class="col-md-6">
                                    <input id="bairro" type="text" class="form-control{{ $errors->has('bairro') ? ' is-invalid' : '' }}" name="bairro" value="{{ $end->bairro }}" required autofocus>

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
                                    <input id="rua" type="text" class="form-control{{ $errors->has('rua') ? ' is-invalid' : '' }}" name="rua" value="{{ $end->rua }}" required autofocus>

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
                                    <input id="titulo" type="text" class="form-control{{ $errors->has('numero') ? ' is-invalid' : '' }}" name="numero" value="{{ $end->numero }}" required autofocus>

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
                                    <input id="observacao" type="text" class="form-control{{ $errors->has('observacao') ? ' is-invalid' : '' }}" name="observacao" value="{{ $end->observacao }}" autofocus>

                                    @if ($errors->has('observacao'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('observacao') }}</strong>
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
                    @endforeach    
                </div>            
            </div>                
        </div>
    </div>
</div>

@endsection
<script>

    window.onload = function(){

        var uf = document.getElementById("ufSelect").value;
        var cidades = <?php echo json_encode($cidades,JSON_PRETTY_PRINT) ?>;
        var endereco = <?php echo json_encode($end,JSON_PRETTY_PRINT) ?>;

        $("#cidade").empty();
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




    function verificaruf(){
        var x = document.getElementById("ufSelect").value;
        var cidades = <?php echo json_encode($cidades,JSON_PRETTY_PRINT) ?>;
        $("#cidade").empty();
        for (var i = 0; i < cidades.length; i++) {

            if(x==cidades[i].uf_codigo){
                $('#cidade').append('<option name="cidade" value="' + cidades[i].cidade_codigo + '">' + cidades[i].cidade_descricao +' CEP: '+ cidades[i].cidade_cep+ '</option>');

            }

        }
    }
</script>
