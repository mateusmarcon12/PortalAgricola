@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(Auth::user())
                <div class="card" style="display: none;">
            @else
                <div class="card">
            @endif

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
        
            <div class="card-header">Anúncios  <a href="{{ route('casaofertademanda.index') }}" class="btn btn-outline-success my-2 my-sm-0"> Mais relevantes</a> <a href="{{ url('/') }}" class="btn btn-outline-success my-2 my-sm-0"> Mais recentes</a></div>
            <div class="col-md-14">
                <div class="card">
                    <div class="card-body">
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
     
            <div class="row">
                @foreach($anu as $ticket)

                <div class="col-lg-6 portfolio-item">

                    <div class="card">

                        <div align="center" style="max-height:100px; max-height: 700px;">
                            @for($i=0;$i<sizeof($imagens);$i++)
                                @if($imagens[$i]['anuncio'] == $ticket->id)
                                    @if($imagens[$i]['imagem'] != null)
                                        <img class="card-img-top img-responsive" style="max-height:100px; width: auto;" src="{{ url('storage/'.$imagens[$i]['imagem']) }}">
                                    @else
                                        <img class="card-img-top img-responsive" style="max-height:100px; width: auto;" src="{{ url('storage/erro.jpg')}}">
                                    @endif
                                    @break
                                @endif
                            @endfor
                        </div>

                        <div class="card-body ">
                            <h2 class="card-title" style="color:green; text-transform: uppercase;">
                                {{$ticket->titulo}}
                            </h2>
                            <div class="row">
                                <div class="col-md-9">
                                    <p class="card-text">
                                       <b> Tipo: {{$ticket->tipoanuncio}} </b><br>
                                       Descrição: {{$ticket->descricao}} <br>

                                    </p>
                                </div>
                                <div class=" col-md-3">
                                    <a href="{{action('AnuncioController@show',$ticket->id)}}" class="btn btn-primary" > Ver Mais</a>   
                                </div>

                           </div>
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
