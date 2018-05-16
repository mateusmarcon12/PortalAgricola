@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                   <h3 align="center">Bem vindo ao Portal de Trocas Agrícola!</h3>
                    <p>Aqui você encontra anúncios de ofertas e demandas de produtos e serviços agricolas.
                        Uma vez cadastrado no portal, você está apto a cadastrar anúncios, contatar outros anunciantes
                    podendo até adiciona-los a uma lista de amigos. Através desta rede de amigos, você e seus amigos do portal poderão
                    indicar anúncios uns aos outros.<br><br>
                    Também é possível avaliar os outros usuários, deixando uma nota e comentário em seu perfil. Através das avaliações
                    é possível identificar os melhores e mais confiáveis anunciantes do portal.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
