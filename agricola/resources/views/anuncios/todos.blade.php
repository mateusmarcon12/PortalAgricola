@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card-header">Anúncios <a href="{{ route('casaofertademanda.index') }}" class="btn btn-outline-success my-2 my-sm-0"> Mais relevantes</a> <a href="{{ url('/') }}" class="btn btn-outline-success my-2 my-sm-0"> Mais recentes</a></div>
            <div class="card">
                <div class="card-body">
                    <form class="form-inline my-2 my-lg-0" method="get" action="{{{ URL::to('lib/search') }}}">
                    @csrf
                          <select name="categoria" class="form-control">
                              <option value="">Categoria</option>
                                    @foreach($categorias as $cat)

                                        <option value="{{$cat->id}}"> {{$cat->nome}}<br>
                                        </option>  
                                    @endforeach
                          </select> 
                          <select name="classificacao" class="form-control">
                              <option value="" >Classificação</option>
                                    @foreach($classificacoes as $clas)

                                        <option value="{{$clas->id}}"> {{$clas->nome}}<br>
                                        </option>  
                                    @endforeach
                          </select> 

                          <select name="tipo" class="form-control">
                              <option value="">Tipo</option>
                              <option value="Oferta">Ofertas</option>
                              <option value="Demanda">Demandas</option>
                          </select>  
                          <select name="estado" class="form-control">
                              <option value="">UF</option>
                                    @foreach($estados as $uf)

                                        <option value="{{$uf->uf_codigo}}"> {{$uf->uf_sigla}}<br>
                                        </option>  
                                    @endforeach
                          </select>
                          <input class="form-control mr-sm-2" name="titulo" type="search" placeholder="titulo" aria-label="Search">
                          
                          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
                        </form>
                </div>            
            </div>                
        </div>

        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="container">

                         @isset($anu)
                        <div>
                          <input class="form-control" id="myInput" type="text" placeholder="Pesquisar..">
                          <!--  <table id="example" class="table sortable table-hover">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Típo</th>
                                    <th>Descrição</th>
                                    <th>Anunciante</th>
                                    <th>Validade</th>
                                    <th></th>



                                </tr>
                                </thead>
                                <tbody id="myTable"> -->

                            <div class="row">
                                @foreach($anu as $ticket)



                                   <!--
                                          @if($ticket->tipoanuncio=='Oferta')
                                           <tr bgcolor="#98FB98">
                                          @else
                                            <tr bgcolor="#00FF7F">
                                          @endif
                                            <td>{{$ticket->titulo}}</td>
                                            <td>{{$ticket->tipoanuncio}}</td>
                                            <td>{{$ticket->descricao}}</td>
                                            <td>{{$ticket->name}}</td>
                                            

                                            <td>{{date( 'd/m/Y' , strtotime($ticket->datavalidade))}}</td>
                                            <td> <a href="{{action('AnuncioController@show',$ticket->id)}}" class="btn btn-primary">Ver Mais</a> </td>

                                            </tr>

                                    <tr>

                                    </tr> -->
                                            <div class="col-lg-6 portfolio-item">

                                                <!--   @if($ticket->tipoanuncio=='Demanda')
                                                        <div class="card h-100" style="border-color: #2ab27b">
                                                    @else
                                                        <div class="card h-100" style="border-color: #0b2e13 ">
                                                    @endif -->
                                                <div class="card h-100">

                                                    <div align="center" style="max-height:100px; max-height: 700px;">
                                                        @for($i=0;$i<sizeof($imagens);$i++)
                                                            @if($imagens[$i]['anuncio'] == $ticket->id)
                                                                @if($imagens[$i]['imagem'] != null)
                                                                    <img class="card-img-top img-responsive" style="max-height:100px; width: auto;" src="{{ url('storage/'.$imagens[$i]['imagem']) }}">
                                                                @else
                                                                    <img class="card-img-top img-responsive" style="max-height:100px; width: auto;" src="{{ url('storage/erro.jpg')}}">
                                                                @endif
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <!--      <a href="#" id="43" name="{{$ticket->id}}"><img class="card-img-top" src="http://placehold.it/700x400"></a>-->
                                                    <div class="card-body ">
                                                        <h2 class="card-title" style="color:green; text-transform: uppercase;">
                                                            {{$ticket->titulo}}
                                                        </h2>

                                                        <p class="card-text">
                                                            <b> Tipo: {{$ticket->tipoanuncio}} </b><br>
                                                            Descrição: {{$ticket->descricao}} <br>

                                                        </p>


                                                        <a href="{{action('AnuncioController@show',$ticket->id)}}" class="btn btn-primary"> Ver Mais</a>

                                                    </div>
                                                </div>
                                            </div>
                                @endforeach

                                </div>

                                        <!--    </tbody>
                            </table> -->
                            {{ $anu->appends(Input::get())->links() }}
                            @endisset
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

