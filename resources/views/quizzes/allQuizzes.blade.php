@extends('layouts.app')
<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('successQuiz'))
                <div class="alert alert-success">
                    {{ session('successQuiz') }}
                </div>
            @endif
            @if (session('failQuiz'))
            <div class="alert alert-danger">
                {{ session('failQuiz') }}
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/') }}">Retour à l'accueil</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Quiz disponibles</div>

                <div class="panel-body">

                    @foreach ($quizzes_by_theme as $quiz_by_theme)
                        @if ($quiz_by_theme['max_point'] > 0)
                            <div class="title"><h2>{{ $quiz_by_theme['theme'] }}</h2></div>

                            @foreach ($quiz_by_theme['quiz'] as $quiz)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6 text-center">
                                            <h3>
                                                <b>{{ $quiz->title }}</b>
                                            </h3>
                                        </div>
                                        @if (!$quiz->exists)
                                            <div class="col-md-6 text-center" style="margin-top: 10px">
                                                <a href="{{ route('quizGet', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                                    Répondre >
                                                </a>
                                            </div>
                                        @else
                                            <div class="col-md-6 text-center">
                                                @if ($quiz->success)
                                                <h3 style="color: green;">Réussi</h3>
                                                @else
                                                <h3 style="color: red;">Echoué</h3>
                                                @endif
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <hr/>
                            @endforeach
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection