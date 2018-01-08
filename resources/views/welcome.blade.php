<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url("/images/paper_texture.jpg");
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
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
        <div class="flex-center position-ref full-height">
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
                        <a href="{{ url('/quiz/map') }}">Jeux</a>
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

            <div class="content">
                <div>
                    <img src="/images/LogoLesVoisins.png"/>
                </div>
            </div>
        </div>
    </body>
</html>
