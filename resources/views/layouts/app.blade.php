<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    <style>
        html, body {
            background: #fff url("/images/paper_texture.jpg");
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .top-left {
            position: absolute;
            left: 0px;
            top: -10px;
        }

        .links > a {
            color: #636b6f;
            top: 10px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;

        }

        .navbar {
            min-height: 70px;
            background: #fff url("/images/paper_texture.jpg");
        }

        .navbar-default {
            box-shadow: 1px 2px darkgrey;
        }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container custom-footer">
                <div class="row">
                    <div class="top-left">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="/images/LogoLesVoisins.png" width="110" height="60" />
                            <!--{{ config('app.name', 'Le Vent Tourne') }}-->
                        </a>
                    </div>
                    <div class="navbar-header center-navbar">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            @if (Route::has('login'))
                            @auth
                            @if (Auth::user()->role == 0)
                            <li class="links">
                                <a href="{{ url('/backoffice/themes/create') }}">Themes</a>
                            </li>
                            <li class="links">
                                <a href="{{ url('/backoffice/quiz') }}">Quiz</a>
                            </li>
                            <li class="links">
                                <a href="{{ url('/backoffice/users') }}">Utilisateurs</a>
                            </li>
                            <li class="links">
                                <a href="{{ url('/backoffice/pages') }}">Pages fantômes</a>
                            </li>
                            @endif
                            @if (Auth::user()->role == 1)
                            <li class="links">
                                <a href="{{ url('/teacher') }}">Mon Compte</a>
                            </li>
                            <li class="links">
                                <a href="{{ url('/teacher/classes') }}">Mes classes</a>
                            </li>
                            <li class="links">
                                <a href="{{ url('/teacher/school/createSchool') }}">Création d'école</a>
                            </li>
                            <li class="links">
                                <a href="{{ url('/teacher/classroom/createClassroom') }}">Création de classe</a>
                            </li>
                            @endif
                            @if (Auth::user()->role == 2)
                            <li class="links">
                                <a>
                                    <img src="/images/Picto_Score.png" width="20">
                                    @if ($data['score'] > $data['max_score'] / 2)
                                    <span style="color: green; font-size: larger;">
                                        {{ $data['score'] }} / {{ $data['max_score'] }}
                                    </span>
                                    @endif
                                    @if ($data['score'] == $data['max_score'] / 2)
                                    <span style="color: orange; font-size: larger;">
                                        {{ $data['score'] }} / {{ $data['max_score'] }}
                                    </span>
                                    @endif
                                    @if ($data['score'] < $data['max_score'] / 2)
                                    <span style="color: red; font-size: larger;">
                                        {{ $data['score'] }} / {{ $data['max_score'] }}
                                    </span>
                                    @endif
                                </a>
                            </li>
                            <li class="links">
                                <a href="{{ url('/quiz/map') }}">Ma Map</a>
                            </li>
                            <li class="links">
                                <a href="{{ url('/student') }}">Mon Compte</a>
                            </li>
                                @endif
                            <li class="links">
                                <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                Déconnexion
                            </a>
                            </li>
                            @else
                            <li class="links">
                                <a href="{{ route('login') }}">Connexion</a>
                            </li>
                            <li class="links">
                                <a href="{{ route('register') }}">Inscription</a>
                            </li>
                            @endauth
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
