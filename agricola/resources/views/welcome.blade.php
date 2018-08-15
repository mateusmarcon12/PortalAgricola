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

                        <div class="card-header">Anúncios</div>

                        <div class="row">

                            @foreach($anu as $ticket)

                                <div class="col-lg-6 portfolio-item">
                                    <!--
                                    @if($ticket->tipoanuncio=='Demanda')
                                        <div class="card h-100" style="background-color: #B0E0E6">
                                    @else
                                        <div class="card h-100" style="background-color:#B0C4DE">
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
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <h2 style="color:green; text-transform: uppercase;">{{$ticket->titulo}}</h2>
                                            </h4>
                                            <p class="card-text">
                                                       <b> Tipo: {{$ticket->tipoanuncio}} </b><br>
                                                        Descrição: {{$ticket->descricao}} <br>
                                                        Anunciante: {{$ticket->name}}<br>
                                                        Validade: {{date( 'd/m/Y' , strtotime($ticket->validade))}}</td>
                                                        <a href="{{action('AnuncioController@show',$ticket->id)}}" class="btn btn-primary"> Ver Mais</a>

                                            </p>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                        {!!$anu->links()!!}
                        @endisset

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
