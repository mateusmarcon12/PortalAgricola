    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Suas Negociações</div>

                <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        
                        <div class="table-responsive">
                        <input class="form-control" id="myInput" type="text" placeholder="Pesquisar..">
                        <table id="example" class="table sortable table-hover">
                            <thead>
                            <tr>
                                <th>Negociação</th>
                                <th>Negociante</th>
                                <th>Situação</th>
                                <th>Resolução</th>
                                <th></th>


                            </tr>
                            </thead>
                            <tbody id="myTable">

                            @isset($negociacaos1)
                            @foreach($negociacaos1 as $ticket)

                                <tr>
                                    
                                    <td>{{$ticket->idnegociacao}}</td>
                                    <td>{{$ticket->nomeanunciante}}</td>
                                    @if($ticket->situacaonegociacao == 'inativa')</td>
                                        <td>Finalizada</td>
                                    @else
                                        <td>Em andamento</td>
                                    @endif
                                    @if($ticket->resultadonegociacao!=null)
                                        <td>{{$ticket->resultadonegociacao}}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                     <td> <a href="{{action('NegociacaoController@show',$ticket->idnegociacao)}}" class="btn btn-primary">Ver mais</a></td>
                                </tr>

                            @endforeach
                            @endisset
                            @isset($negociacaos2)
                            @foreach($negociacaos2 as $ticket2)

                                <tr>
                                    
                                    <td>{{$ticket2->idnegociacao}}</td>
                                    <td>{{$ticket2->nomeanunciante}}</td>
                                    @if($ticket2->situacaonegociacao == 'inativa')</td>
                                        <td>Finalizada</td>
                                    @else
                                        <td>Em andamento</td>
                                    @endif
                                    @if($ticket2->resultadonegociacao!=null)
                                        <td>{{$ticket2->resultadonegociacao}}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                      <td> <a href="{{action('NegociacaoController@show',$ticket2->idnegociacao)}}" class="btn btn-primary">Ver mais</a></td>
                                </tr>
                                <tr>

                                </tr>
                            @endforeach
                            @endisset

                            </tbody>
                        </table>
                       
                        </div>


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

$(document).ready(function() {
    $('#example').DataTable();
} );


</script>