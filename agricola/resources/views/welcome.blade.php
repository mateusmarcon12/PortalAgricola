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
                        <h3 align="center">Bem vindo ao Portal de Trocas Agrícola!</h3>
                        <p>Aqui você encontra anúncios de ofertas e demandas de produtos e serviços agricolas.
                            Uma vez cadastrado no portal, você está apto a cadastrar anúncios, contatar outros anunciantes
                            podendo até adiciona-los a uma lista de amigos. Através desta rede de amigos, você e seus amigos do portal poderão
                            indicar anúncios uns aos outros.<br><br>
                            Também é possível avaliar os outros usuários, deixando uma nota e comentário em seu perfil. Através das avaliações
                            é possível identificar os melhores e mais confiáveis anunciantes do portal.</p>

                        <div class="card-header">Anúncios</div>
                        <div class="table-responsive">
                            <table class="table table table-hover">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Típo</th>
                                    <th>Descrição</th>
                                    <th>Anunciante</th>
                                    <th>Validade</th>
                                    



                                </tr>
                                </thead>
                                <tbody>


                                @foreach($anu as $ticket)



                                        

                                            <tr>

                                            <td>{{$ticket->titulo}}</td>
                                            <td>{{$ticket->tipoanuncio}}</td>
                                            <td>{{$ticket->descricao}}</td>
                                            <td>{{$ticket->name}}</td>
                                            

                                            <td>{{date( 'd/m/Y' , strtotime($ticket->validade))}}</td>


                                            </tr>

                                    <tr>

                                    </tr>

                                @endforeach



                                </tbody>
                            </table>
                            {!!$anu->links()!!}
                            @endisset
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection