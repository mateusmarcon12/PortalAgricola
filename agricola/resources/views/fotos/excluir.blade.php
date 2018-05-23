@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Imagens</div>

                    <div class="card-body">

                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @isset($files)
                            <div style="clear:both" class="row">
                                @foreach($files as $f)
                                    <div class="row float-left col-md-6">
                                        <div style="width: 100%">
                                        <form method="POST" enctype="multipart/form-data" action="{{ route('fotos.apagar',Auth::user()->id) }}">
                                            @csrf
                                            <input type="hidden" type="text" name="images" id="file" value="{{$f}}">
                                           <img class="img-responsive rounded float-left" width="100" src="{{ url('storage/'.$f) }}"  alt="Anuncio">

                                           <button type="submit" width="100" class="btn btn-danger">
                                                        {{ __('Excluir') }}
                                                    </button></td>


                                        </form>
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                            </div>
                            @endisset
                            <div align="center" class="align-content-center">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection