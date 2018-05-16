@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Suas Conversa</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        @isset($conversas)
                        <div class="table-responsive">
                        <table class="table table table-hover">
                            <thead>
                            <tr>
                                <th>Usuário</th>
                                <th></th>


                            </tr>
                            </thead>
                            <tbody>


                            @foreach($conversas as $ticket)

                                <tr>
                                    @if($ticket->idusuario1 != Auth::user()->id)
                                    <td>{{$ticket->idusuario1}}</td>
                                    @else
                                    <td>{{$ticket->idusuario2}}</td>
                                    @endif
                                     <td> <a href="{{action('ConversaController@show',$ticket->id)}}" class="btn btn-primary">Exibir Conversa</a></td>
                                </tr>
                                <tr>

                                </tr>
                            @endforeach



                            </tbody>
                        </table>
                        @endisset
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

