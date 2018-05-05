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

                                        @if ($errors->has('nome'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                
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

