@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Anunciantes do Portal</div>

                    <div class="card-body">

                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @isset($files)

                                @foreach($files as $f)
                                    <div style="clear:both" class="row justify-content-center">
                                        <form method="POST" enctype="multipart/form-data" action="{{ route('fotos.apagar',Auth::user()->id) }}">
                                            @csrf
                                            <input type="hidden" type="text" name="images" id="file" value="{{$f}}">
                                           <img class="img-responsive rounded float-left" width="100" src="{{ url('storage/'.$f) }}"  alt="Anuncio">

                                           <button type="submit" class="btn btn-danger float-right">
                                                        {{ __('Excluir') }}
                                                    </button></td>


                                        </form>

                                    </div>
                                    <br>
                                @endforeach

                            @endisset
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection