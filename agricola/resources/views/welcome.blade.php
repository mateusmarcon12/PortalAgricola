@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Seja Bem Vindo! Faça login ou cadastre-se para explorar mais ferramentas do portal</div>



                    <div class="card-body">


                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @isset($anu)
                        <h3 align="center">Bem vindo ao AgriTroca - Portal de Trocas Agrícola!</h3>
                        <p>Aqui você encontra anúncios de ofertas e demandas de produtos e serviços agricolas.
                            Uma vez cadastrado no portal, você está apto a cadastrar anúncios, contatar outros anunciantes
                            podendo até adiciona-los a uma lista de amigos. Através desta rede de amigos, você e seus amigos do portal poderão
                            indicar anúncios uns aos outros.<br><br>
                            Também é possível avaliar os outros usuários, deixando uma nota e comentário em seu perfil. Através das avaliações
                            é possível identificar os melhores e mais confiáveis anunciantes do portal.</p>
</div>
                    </div>
                <div class="col-md-14">
                    <div class="card">
                        <div class="card-body">
                            <!--
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Tipo de Anuncio
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('anuncio.ofer') }}">Ofertas</a>
                              <a class="dropdown-item" href="{{ route('anuncio.dem') }}">Demandas</a>

                            </div>
                          </li>
                        </ul>
-->

                            <form class="form-inline my-2 my-lg-0" method="get" action="{{ URL::to('/welcome/search') }}">
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

                                        <option value="{{$uf->uf_codigo}}"> {{$uf->uf_descricao}}<br>
                                        </option>
                                    @endforeach
                                </select>
                                <input class="form-control mr-sm-2" name="titulo" type="search" placeholder="titulo" aria-label="Search">

                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
                            </form>
                        </div>
                    </div>
                </div>
                        <div class="card-header">Anúncios</div>


                        <div class="row">

                            @foreach($anu as $ticket)





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


                        {{ $anu->appends(Input::get())->links() }}

                        @endisset

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
