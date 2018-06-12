<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('tablesortcss/Scripts/bootstrap-sortable.js') }}" defer></script>
    <script src="{{ asset('tablesortcss/Scripts/moment.min.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('tablesortcss/Contents/bootstrap-sortable.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img align="center" class="img-responsive rounded" width="60" src="{{ url('storage/logo.png') }}"  alt="Anuncio">
                </a>
                <a class="navbar-brand responsive" href="{{ url('/') }}">
                   <!-- {{ config('app.name', 'Laravel') }} -->
                    Portal de trocas agrícolas
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar') }}</a></li>
                        @else

                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Amigos | Anunciantes<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('amizades.show',Auth::user()->id) }}">
                                        {{ __('Meus Amigos') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('usuario.todos',Auth::user()->id) }}">
                                        {{ __('Todos anunciantes') }}
                                    </a>

                                </div>
                            </li>
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Anúncios <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('oferta.create') }}">
                                        {{ __('Cadastrar Oferta') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('demanda.create') }}">
                                        {{ __('Cadastrar Demanda') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('casaofertademanda.index') }}">
                                        {{ __('Casar Anúncios') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('anuncio.listtodos') }}">
                                        {{ __('Exibir todos anúncios') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('anuncio.index') }}">
                                        {{ __('Meus Anúncios') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('negociacao.index') }}">
                                        {{ __('Minhas Negociações') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('anuncio.recomendados') }}">
                                        {{ __('Recomendados por amigos') }}
                                    </a>


                                </div>
                            </li>
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('user.show', Auth::user()->id) }}">
                                        {{ __('Perfil') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
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