


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
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>