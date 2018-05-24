
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
                        @isset($usuarios)
                        <div class="table-responsive">
                            <input class="form-control" id="myInput" type="text" placeholder="Pesquisar..">
                            Ordenar:
                            <a href="/usuario/todos/id/?gender=e-mail">E-mail</a>
                            <table id="example" class="table table-hover sortable">
                                <thead>
                                <tr>
                                    <th data-firstsort="cresc">Anunciante</th>
                                    <th>E-mail</th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody id="myTable">


                                @foreach($usuarios as $ticket)

                                            <tr>

                                            <td>{{$ticket->name}}</td>
                                            <td>{{$ticket->email}}</td>
                                            <td><a href="{{route('usuario.exibeoutro', $ticket->id)}}" class="btn btn-primary">Ver Mais</a></td>
                                            <td><a href="{{route('solicitacao.store', $ticket->id)}}" class="btn btn-primary">Solicitar Amizade</a></td>

                                            </tr>

                                    <tr>

                                    </tr>

                                @endforeach



                                </tbody>
                            </table>
                            {!!$usuarios->links()!!}
                            @endisset
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>

</script>