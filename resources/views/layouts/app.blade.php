<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RIVS</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    RIVS
                    <img class="img1" src="{{ asset('images/screw1.png') }}">

                    <img class="img2" src="{{ asset('images/screw3.png') }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> S'identifier</a>
                            </li>
                        @else
                            <li class="nav-item">
                              <a href="{{route('products.list')}}" class="nav-link"><i class="fa fa-tags" aria-hidden="true"></i> Inventaire</a>
                            </li>
                            @if(Session::get('car'))
                            <li class="nav-item" >
                              <a href="{{route('bank.car')}}" class="nav-link"><i class="fas fa-database"></i> Modifier <span class="badge bg-light">{{Session::get('car')?Session::get('car')->units : null}}</span></a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('orders.mylist')}}">
                                      <i class="fas fa-list-alt" aria-hidden="true"></i> Mon historique
                                    </a>
                                    <a class="dropdown-item" href="{{route('users.gestion')}}">
                                      <i class="fa fa-cog" aria-hidden="true"></i> Gestion usagers
                                    </a>
                                    <a class="dropdown-item" href="{{route('category.gestion')}}">
                                      <i class="fa fa-cog" aria-hidden="true"></i> Gestion catégorie
                                    </a>
                                    <a class="dropdown-item" href="{{route('products.gestion')}}">
                                      <i class="fa fa-cog" aria-hidden="true"></i> Gestion produits
                                    </a>
                                    <a class="dropdown-item" href="{{route('orders.gestion')}}">
                                      <i class="fa fa-th-list" aria-hidden="true"></i> Gestion des commandes
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i> Deconnexion
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
