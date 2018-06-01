    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                        <form class="form-inline my-2 my-lg-0" method="POST" enctype="multipart/form-data" action="{{ route('negociacao.filtrar') }}">
                           @csrf

                          <select name="situacao" class="form-control">
                              <option value="">Situação</option>
                              <option value="ativa">Em andamento</option>
                              <option value="inativa">Finalizada</option>

                          </select>  
                          <select name="resolucao" class="form-control">
                              <option value="">Resolução</option>
                              <option value="sucesso">Sucesso</option>
                              <option value="insucesso">Insucesso</option>
                          </select>  
                          
                          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
                          
                        </form>
                          <i style="clear:both"><br>Selecionando uma resolução o campo "situação" será ignorado</i>
                </div>            
            </div>                
        </div>

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

                            @isset($negociacaos)
                            @foreach($negociacaos as $ticket)

                                <tr>
                                    
                                    <td>{{$ticket->idnegociacao}}</td>
                                   @if($ticket->idanunciante1 == Auth::user()->id)
                                        <td>{{$ticket->nomeanunciante2}}</td>
                                   @elseif($ticket->idanunciante2 == Auth::user()->id)
                                        <td>{{$ticket->nomeanunciante1}}</td>
                                   @endif
                                    @if($ticket->situacaonegociacao == 'inativa')
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

                            </tbody>
                        </table>
                            {!!$negociacaos->links()!!}
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