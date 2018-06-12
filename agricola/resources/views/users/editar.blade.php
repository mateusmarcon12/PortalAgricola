
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
                                        <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>

                                        <div class="col-md-6">
                                            <input id="telefone" type="text" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" name="telefone" value="{{ $usuario->telefone}}">

                                            @if ($errors->has('telefone'))
                                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('telefone') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="celular" class="col-md-4 col-form-label text-md-right">{{ __('Celular') }}</label>

                                        <div class="col-md-6">
                                            <input id="celular" type="text" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celular" value="{{ $usuario->celular}}">

                                            @if ($errors->has('celular'))
                                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('celular') }}</strong>
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
                                            <input type="text" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" id="cpf" onchange="habilitacadastrarcpf()" value="{{ $usuario->cpf  }}">

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
                                            <input type="text" id="cnpj" onchange="habilitacadastrarcnpj()" class="form-control{{ $errors->has('cnpj') ? ' is-invalid' : '' }}" name="cnpj" value="{{ $usuario->cnpj }}">

                                            @if ($errors->has('cnpj'))
                                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('cnpj') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0 justify-content-center">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" id="cadastrar" class="btn btn-primary">
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
            $("#cnpj").val("");
            $("#sexoa").show(1000);
            $("#cpfa").show(1000);
            $("#cnpja").hide(1000);
            

        }
        if(x=='CNPJ'){
            $("#cpf").val("");
            $("#cnpja").show(1000);
            $("#cpfa").hide(1000);
            $("#sexoa").hide(1000);
        }
        if(x==''){
            $("#cnpj").val("");
            $("#cpf").val("");
            $("#cpfa").hide(1000);
            $("#cnpja").hide(1000);
            $("#sexoa").hide(1000);
            $("#cadastrar").hide(1000);
        }

    }
    function habilitacadastrarcpf(){

        var strCPF = document.getElementById("cpf").value;
        strCPF = strCPF.replace(/[^\d]+/g,'');
        var Soma;
        var Resto;
        Soma = 0;
        if (strCPF == "00000000000"){ $("#cadastrar").hide(1000); return false;}

        for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(strCPF.substring(9, 10)) ){ $("#cadastrar").hide(1000); return false;}

        Soma = 0;
        for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(strCPF.substring(10, 11) ) ) { $("#cadastrar").hide(1000); return false;}

        $("#cadastrar").show(1000);
    }

    function habilitacadastrarcpnj(){
        var cnpj = document.getElementById("cnpj").value;
        cnpj = cnpj.replace(/[^\d]+/g,'');

        if(cnpj == '') return false;

        if (cnpj.length != 14)
            return false;

        // Elimina CNPJs invalidos conhecidos
        if (cnpj == "00000000000000" ||
                cnpj == "11111111111111" ||
                cnpj == "22222222222222" ||
                cnpj == "33333333333333" ||
                cnpj == "44444444444444" ||
                cnpj == "55555555555555" ||
                cnpj == "66666666666666" ||
                cnpj == "77777777777777" ||
                cnpj == "88888888888888" ||
                cnpj == "99999999999999")
            return false;

        // Valida DVs
        tamanho = cnpj.length - 2;
        numeros = cnpj.substring(0,tamanho);
        digitos = cnpj.substring(tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;

        tamanho = tamanho + 1;
        numeros = cnpj.substring(0,tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;

        $("#cadastrar").show(1000);
    }
</script>
