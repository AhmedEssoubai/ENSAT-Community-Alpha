<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ENSAT Community') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-groupe.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-profil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-global.css') }}">
    <!--<link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">-->
    <script defer src="{{ asset('fontawesome/js/all.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}" type="text/javascript"></script>
    <!--<script src="https://kit.fontawesome.com/666d79cf59.js" crossorigin="anonymous"></script>-->
    <script src="js/sidenav-scripte.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light fixed-top">
            <div class="container d-flex">
                <h5 class="mr-3"><a class="icon-mute" role="button" onclick="openNav()"><i class="fa fa-bars"></i></a></h5>
                <a href="#" class="navbar-brand d-flex">
                    <h4 class="text-primary">ENSAT</h4>
                    <span class="mx-2">Community</span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="btn btn-os navbar-btn mr-2" href="{{ route('login') }}">Se connecter</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary navbar-btn" href="{{ route('register') }}">S'inscrire</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administration</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.users.pending') }}">Users</a>
                                    <a class="dropdown-item" href="{{ route('admin.groupes.all') }}">Classes</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <img src="img/avatar-0.png" id="dml_profil" class="img-fluid rounded-circle dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" />
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dml_profil">
                                    <a class="dropdown-item" href="#">Bookmark</a>
                                    <a class="dropdown-item" href="#">Setting</a>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        Se déconnecter
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 bg-light">
            <div id="side_menu_container" class="fixed-top px-0">
                <div id="side_menu" class="pt-3 pb-3 shadow text-center text-white px-0">
                    <div id="side_menu_content">
                        <h6 class="text-right mx-5"><a class="icon-mute" role="button" onclick="closeNav()"><i class="fa fa-times"></i></a></h6>
                        <div class="mt-3 py-3 side-menu-title">
                            <h3>Courses</h3>
                        </div>
                        <div class="m-4 text-left">
                            <h5 class="mt-4 d-flex justify-content-between">
                                Java
                            </h5>
                            <h5 class="mt-4 d-flex justify-content-between">
                                Cloud Computing
                            </h5>
                            <h5 class="mt-4 d-flex justify-content-between">
                                Python
                                <span class="badge badge-pill badge-danger">10</span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </main>

        <footer>
            <div class="border-top"></div>
            <div class="container">
                <div class="row my-3">
                    <img src="img/logo.png" class="img-fluid mr-3" width="160px" />
                    <span class="lead mr-auto my-auto">
                        Copyright © 2020
                    </span>
                    <img src="img/ensa-tanger.png" class="img-fluid" width="80px" />
                </div>
            </div>
            <div class="bar"></div>
        </footer>
    </div>
</body>
</html>
