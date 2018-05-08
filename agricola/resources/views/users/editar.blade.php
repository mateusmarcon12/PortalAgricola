@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Editar perfil</div>
                    <div class="card-body">


                            <form method="POST" enctype="multipart/form-data" action="{{route('user.update',$usuario->id)}}">
                                @csrf
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
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>                                
                                <div class="form-group row justify-content-center">
                                    
                                    <div class="col-md-3">
                                        <div>
                                            <label for="datanasc" class="col-form-label text-md-right">{{ __('Data de Nascimento') }}</label>
                                        </div>
                                        <div >
                                            <input id="datanasc" type="date" class="form-control{{ $errors->has('datanasc') ? ' is-invalid' : '' }}" name="datanasc" value="{{ old('datanasc') }}" required autofocus>

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
                                       
                                                <option value=""> </option>
                                                <option value="CPF"> CPF</option>
                                                <option value="CNPJ"> CNPJ</option>
                                        
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div id="cpf" style="display:none" class="form-group row">
                                    <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('CPF') }}</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" value="{{ old('cpf') }}" required autofocus>

                                        @if ($errors->has('cpf'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div id="sexo" style="display:none" class="form-group row">
                                    <label for="sexo" class="col-md-4 col-form-label text-md-right">{{ __('Sexo') }}</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control{{ $errors->has('sexo') ? ' is-invalid' : '' }}" name="sexo" value="{{ old('sexo') }}" required autofocus>

                                        @if ($errors->has('sexo'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sexo') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div id="cnpj" style="display:none" class="form-group row">
                                    <label for="cnpj" class="col-md-4 col-form-label text-md-right">{{ __('CNPJ') }}</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control{{ $errors->has('cnpj') ? ' is-invalid' : '' }}" name="cnpj" value="{{ old('cnpj') }}" required autofocus>

                                        @if ($errors->has('cnpj'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('cnpj') }}</strong>
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

function verificartipo() {
    var x = document.getElementById("classificacaoSelect").value;
    if(x=='CPF'){
        $("#cpf").show(1000);
        $("#sexo").show(1000);
        $("#cnpj").hide(1000);
    }
    if(x=='CNPJ'){
        $("#cnpj").show(1000);
        $("#cpf").hide(1000);
        $("#sexo").hide(1000);
    }
    if(x==''){
        $("#cpf").hide(1000);
        $("#cnpj").hide(1000);
        $("#sexo").hide(1000);
    }
    
}

</script>