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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css" />
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/material.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">Quiz</span>
        </div>
    </header>
    <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
            <img src="https://raw.githubusercontent.com/google/material-design-lite/mdl-1.x/templates/dashboard/images/user.jpg" class="demo-avatar">
            <div class="demo-avatar-dropdown">
                <span>{{ Auth::user()->email }}</span>
            </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
            @if (Auth::user()->role == 0)
            <a class="mdl-navigation__link" href="{{ url('/backoffice') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">security</i>Backoffice</a>
            <a class="mdl-navigation__link" href="{{ url('/backoffice/quiz') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">apps</i>Quiz</a>
            <a class="mdl-navigation__link" href="{{ url('/backoffice/users') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">supervisor_account</i>Utilisateurs</a>
            <a class="mdl-navigation__link" href="{{ url('/backoffice/pages') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">description</i>Pages fantômes</a>
            @endif
            @if (Auth::user()->role == 2)
            <a class="mdl-navigation__link" href="{{ url('/student') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">face</i>Mon Compte</a>
            <a class="mdl-navigation__link" href="{{ url('/quiz') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">apps</i>Quiz</a>
            @endif
            <a class="mdl-navigation__link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">exit_to_app</i>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                Déconnexion
            </a>
            <div class="mdl-layout-spacer"></div>
            <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
        </nav>
    </div>
    @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
