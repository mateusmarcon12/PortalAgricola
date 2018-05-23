@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Alterar Senha</div>
                    
                    <div id="geral" class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                            <form method="POST" enctype="multipart/form-data" action="{{route('usuario.salvarsenha')}}">
                                @csrf
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