@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de usuário') }}</label>

                            <div class="col-md-6">

                                <select class="form-control" name="tipo" id="classificacaoSelect" onchange="verificartipo()" required>

                                    <option value=""> </option>
                                    <option value="CPF"> CPF</option>
                                    <option value="CNPJ"> CNPJ</option>

                                </select>

                            </div>
                        </div>
                        <div id="cpfa" style="display:none" class="form-group row">
                            <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('CPF') }}</label>

                            <div class="col-md-6">
                                <input type="text" id="cpf" onchange="habilitacadastrarcpf()" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" id="cpf">

                                @if ($errors->has('cpf'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('cpf') }}</strong>
                                        </span>
                                @endif
                                <i>*Insira apenas os números, sem caracteres especiais(.,/)</i>
                            </div>
                        </div>
                        <div id="cnpja" style="display:none" class="form-group row">
                            <label for="cnpj" class="col-md-4 col-form-label text-md-right">{{ __('CNPJ') }}</label>

                            <div class="col-md-6">
                                <input type="text" id="cnpj" onchange="habilitacadastrarcpnj()" class="form-control{{ $errors->has('cnpj') ? ' is-invalid' : '' }}" name="cnpj">

                                @if ($errors->has('cnpj'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('cnpj') }}</strong>
                                        </span>
                                @endif
                                <i>*Insira apenas os números, sem caracteres especiais(.,/)</i>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirme a senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="cadastrar" class="btn btn-primary">
                                    {{ __('Cadastrar') }}
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

    window.onload = function() {
        var x = document.getElementById("classificacaoSelect").value;
        if(x!=''){
            verificartipo();
        }
        $("#cadastrar").hide(1000);
        //example function call.
    };

    function verificartipo() {
        var x = document.getElementById("classificacaoSelect").value;
        if(x=='CPF'){
            $("#cnpj").val("");
            $("#cpfa").show(1000);
            $("#cnpja").hide(1000);
            $("#cadastrar").hide(1000);

        }
        if(x=='CNPJ'){
            $("#cpf").val("");
            $("#cnpja").show(1000);
            $("#cpfa").hide(1000);
            $("#cadastrar").hide(1000);
        }
        if(x==''){
            $("#cnpj").val("");
            $("#cpf").val("");
            $("#cpfa").hide(1000);
            $("#cnpja").hide(1000);

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