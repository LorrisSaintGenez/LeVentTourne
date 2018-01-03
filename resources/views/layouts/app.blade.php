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


    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: inherit;
        }

        .top-left {
            position: absolute;
            left: 10px;
            top: 18px;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="flex-center position-ref">
                    <div class="top-left links">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Le Vent Tourne') }}
                        </a>
                    </div>
                    @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            @if (Auth::user()->role == 0)
                            <a href="{{ url('/backoffice/themes/create') }}">Themes</a>
                            <a href="{{ url('/backoffice/quiz') }}">Quiz</a>
                            <a href="{{ url('/backoffice/users') }}">Utilisateurs</a>
                            <a href="{{ url('/backoffice/pages') }}">Pages fantômes</a>
                            @endif
                            @if (Auth::user()->role == 1)
                            <a href="{{ url('/teacher') }}">Mon Compte</a>
                            <a href="{{ url('/teacher/classes') }}">Mes classes</a>
                            <a href="{{ url('/teacher/school/createSchool') }}">Création d'école</a>
                            <a href="{{ url('/teacher/classroom/createClassroom') }}">Création de classe</a>
                            @endif
                            @if (Auth::user()->role == 2)
                            <a>Score :
                                @if ($data['score'] > $data['max_score'] / 2)
                                <span style="color: green;">
                                    {{ $data['score'] }} / {{ $data['max_score'] }}
                                </span>
                                @endif
                                @if ($data['score'] == $data['max_score'] / 2)
                                <span style="color: orange;">
                                    {{ $data['score'] }} / {{ $data['max_score'] }}
                                </span>
                                @endif
                                @if ($data['score'] < $data['max_score'] / 2)
                                <span style="color: red;">
                                    {{ $data['score'] }} / {{ $data['max_score'] }}
                                </span>
                                @endif

                            </a>
                            <a href="{{ url('/quiz/map') }}">Ma Map</a>
                            <a href="{{ url('/student') }}">Mon Compte</a>
                            @endif
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                Déconnexion
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @else
                            <a href="{{ route('login') }}">Connexion</a>
                            <a href="{{ route('register') }}">Inscription</a>
                        @endauth
                    </div>
                    @endif
                </div>

<!--                <div class="collapse navbar-collapse" id="app-navbar-collapse">-->
<!--                    <ul class="nav navbar-nav">-->
<!--                        &nbsp;-->
<!--                    </ul>-->
<!---->
<!--                    <ul class="nav navbar-nav navbar-right">-->
<!--                        @guest-->
<!--                            <li><a href="{{ route('login') }}">Connexion</a></li>-->
<!--                            <li><a href="{{ route('register') }}">Inscription</a></li>-->
<!--                        @else-->
<!--                            <li class="dropdown">-->
<!--                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">-->
<!--                                    {{ Auth::user()->name }} <span class="caret"></span>-->
<!--                                </a>-->
<!---->
<!--                                <ul class="dropdown-menu" role="menu">-->
<!--                                    <li>-->
<!--                                        @if (Auth::user()->role == 0)-->
<!--                                            <a href="{{ url('/backoffice') }}">Backoffice</a>-->
<!--                                            <a href="{{ url('/backoffice/themes/create') }}">Themes</a>-->
<!--                                            <a href="{{ url('/backoffice/quiz') }}">Quiz</a>-->
<!--                                            <a href="{{ url('/backoffice/users') }}">Utilisateurs</a>-->
<!--                                            <a href="{{ url('/backoffice/pages') }}">Pages fantômes</a>-->
<!--                                        @endif-->
<!--                                        @if (Auth::user()->role == 1)-->
<!--                                        <a href="{{ url('/teacher') }}">Mon Compte</a>-->
<!--                                        <a href="{{ url('/teacher/school/createSchool') }}">Création d'école</a>-->
<!--                                        <a href="{{ url('/teacher/classroom/createClassroom') }}">Création de classe</a>-->
<!--                                        @endif-->
<!--                                        @if (Auth::user()->role == 2)-->
<!--                                        <a href="{{ url('/quiz/map') }}">Ma Map</a>-->
<!--                                        <a href="{{ url('/student') }}">Mon Compte</a>-->
<!--                                        @endif-->
<!--                                        <a href="{{ route('logout') }}"-->
<!--                                            onclick="event.preventDefault();-->
<!--                                                     document.getElementById('logout-form').submit();">-->
<!--                                            Déconnexion-->
<!--                                        </a>-->
<!---->
<!--                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">-->
<!--                                            {{ csrf_field() }}-->
<!--                                        </form>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                        @endguest-->
<!--                    </ul>-->
<!--                </div>-->
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</body>
</html>
