@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Sua Conversa</div>

                <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        @isset($mensagens)
                        <div class="col-md-12 justify-content-center">
                            @foreach($mensagens as $c)
                                <div style="clear: both">
                                    @if($c->idremetente == Auth::user()->id)
                                        <div class="col-md-6 float-right" align="justify">
                                            Mensagem de: {{ Auth::user()->name }}
                                    @else
                                       <div class="col-md-6 float-left" align="justify">
                                           Mensagem de:
                                    @endif
                                           <p>{{$c->mensagem}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endisset

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

