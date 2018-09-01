@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card">

                <div class="card-body">


                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h3 align="center">Bem vindo ao AgriTroca - Portal de Trocas Agrícola!</h3>
                    <p>Aqui você encontra anúncios de ofertas e demandas de produtos e serviços agricolas.
                        Uma vez cadastrado no portal, você está apto a cadastrar anúncios, contatar outros anunciantes
                        podendo até adiciona-los a uma lista de amigos. Através desta rede de amigos, você e seus amigos do portal poderão
                        indicar anúncios uns aos outros.<br><br>
                        Também é possível avaliar os outros usuários, deixando uma nota e comentário em seu perfil. Através das avaliações
                    é possível identificar os melhores e mais confiáveis anunciantes do portal.</p>
                </div>
            </div>
        
            <div class="card-header">Informações</div>
                <div class="col-md-14">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">Conta de usuário</div>
                                    <p class="text-justify"><br>As contas de usuário devem possuir um CPF/CNPJ e um e-mail únicos no portal,
                                        ou seja, você só poderá cadastrar-se informando estes itens e estes não podem ter sido utilizado por outro usuário.
                                        <br>
                                        Em caso de você não lembrar sua senha, vá até a página de login e seleciona e opção "Esqueceu sua senha?" e siga as instruções.
                                    </p>
                            <div class="card-header">Casar anúncios</div>
                                    <p class="text-justify"><br> Está função análise os seus anúncios e então lista para você
                                    os anúncios com maior grau de compatibilidade com cada um dos seus respectivamente.
                                    <br>
                                     São comparadas demandas com ofertas e vice e versa. Já grau de compatibilidade pode variar de 2 até 10, e os parâmetros utilizado para comparação são:
                                        <li>Tipo</li>
                                        <li>Categoria</li>
                                        <li>Título</li>
                            </p><br>
                            <div class="card-header">Negociação</div>
                            <p class="text-justify"><br> As negociações são realizadas diretamente entre os usuários,
                                ou seja, os termos da negociação não sofrem interferência do portal.
                                Ao abrir uma negociação, os anúncios a ela vinculados serão bloqueados para os demais usuários,
                                Se a negociação for concluída com "sucesso", o(s) anúncio(s) serão inativados. Caso a mesma seja
                                finalizada com insucesso os mesmos são desbloqueados. Na abertura da negociação, o usuário recebe um
                                e-mail de notificação. Caso a negociação não receba atualizações em 60 dias, o portal poderá concluir a mesma.
                            </p><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
