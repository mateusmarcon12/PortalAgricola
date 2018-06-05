
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Editar perfil</div>
                    <div id="geral" class="card-body">


                            <form method="POST" enctype="multipart/form-data" action="{{route('usuario.update')}}">
                                @csrf
                                <div class="col-md-12 justify-content-center">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="name" value="{{ $usuario->name}}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $usuario->email }}" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>                                
                                    <div class="form-group col-md-12 row justify-content-center">
                                        
                                        <div class="col-md-3">
                                            <div>
                                                <label for="datanasc" class="col-form-label text-md-right">{{ __('Data de Nascimento') }}</label>
                                            </div>
                                            <div >
                                                <input id="datanasc" type="date" class="form-control{{ $errors->has('datanasc') ? ' is-invalid' : '' }}" name="datanasc" value="{{ $usuario->datanasc }}" required autofocus>

                                                @if ($errors->has('datanasc'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('datanasc') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>    
                                        <div class="col-md-3">
                                            <div>   
                                                <label for="titulo" class="col-form-label text-md-right">{{ __('Tipo de usuário') }}</label>
                                            </div>    
                                            <div >
          
                                                <select class="form-control" name="tipo" id="classificacaoSelect" onchange="verificartipo()" >
                                                    @if ($usuario->cpf != null)
                                                        <option value="CPF"> CPF</option>
                                                    @endif
                                                    @if ($usuario->cnpj != null)
                                                            <option value="CNPJ"> CNPJ</option>
                                                    @endif
                                                    @if (($usuario->cnpj == null) && ($usuario->cpf == null))
                                                        <option value=""> </option>
                                                        <option value="CPF"> CPF</option>
                                                        <option value="CNPJ"> CNPJ</option>
                                                    @endif

                                            
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div id="cpfa" style="display:none" class="form-group row">
                                        <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('CPF') }}</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" id="cpf" value="{{ $usuario->cpf  }}">

                                            @if ($errors->has('cpf'))
                                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('cpf') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="sexoa" style="display:none" class="form-group row">
                                        <label for="sexo" class="col-md-4 col-form-label text-md-right">{{ __('Sexo') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-control" name="sexo" >
                                                @if ($usuario->sexo == 'Masculino')
                                                    <option value="Masculino"> Masculino</option>
                                                @endif
                                                @if ($usuario->sexo == 'Feminino')
                                                    <option value="Feminino">Feminino</option>
                                                @endif
                                                @if ($usuario->sexo == 'Outro')
                                                    <option value="Outro"> Outro</option>
                                                @endif
                                                    <option value="Masculino"> Masculino</option>
                                                    <option value="Feminino">Feminino</option>
                                                    <option value="Outro"> Outro</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div id="cnpja" style="display:none" class="form-group row">
                                        <label for="cnpj" class="col-md-4 col-form-label text-md-right">{{ __('CNPJ') }}</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control{{ $errors->has('cnpj') ? ' is-invalid' : '' }}" name="cnpj" value="{{ $usuario->cnpj }}">

                                            @if ($errors->has('cnpj'))
                                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('cnpj') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0 justify-content-center">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
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

<script>

    window.onload = function() {
        var x = document.getElementById("classificacaoSelect").value;
        if(x!=''){
            verificartipo();
        }
        //example function call.
    };

function verificartipo() {
    var x = document.getElementById("classificacaoSelect").value;
    if(x=='CPF'){
        $("#cpfa").show(1000);
        $("#sexoa").show(1000);
        $("#cnpja").hide(1000);

    }
    if(x=='CNPJ'){
        $("#cnpja").show(1000);
        $("#cpfa").hide(1000);
        $("#sexoa").hide(1000);
    }
    if(x==''){
        $("#cpfa").hide(1000);
        $("#cnpja").hide(1000);
        $("#sexoa").hide(1000);
    }
    
}

</script>