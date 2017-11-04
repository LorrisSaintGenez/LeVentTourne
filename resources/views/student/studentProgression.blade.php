@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/') }}">Retour à l'accueil</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Ma progression</div>

                <div class="panel-body">

                    @foreach ($quizzes_by_theme as $quiz_by_theme)
                        <div class="title"><h2>Thème : {{ $quiz_by_theme['theme'] }}</h2></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 text-center">
                                    <h3>
                                        <b>Score : {{ $quiz_by_theme['score'] }}</b>
                                    </h3>
                                </div>
                                <div class="col-md-6 text-center">
                                    <h3>
                                        <b>Score Max. : {{ $quiz_by_theme['max_point'] }}</b>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection