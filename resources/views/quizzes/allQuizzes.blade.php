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
            @foreach ($themes_with_quizzes as $theme_with_quizzes)
            <div class="col-lg-4 col-md-6">
                @if ($theme_with_quizzes['max_point'] > 0)
                    @if (count($theme_with_quizzes['quiz']) > 0)
                        <form id="form" class="form-horizontal" method="GET" action="{{ route('quizGet', $theme_with_quizzes['id']) }}" enctype="multipart/form-data">
                            <div class="quiz quiz_with_question" onclick=this.parentNode.submit();>
                                <h2 style="margin-top: 0 !important;">{{ $theme_with_quizzes['theme'] }}</h2>
                                @if ($theme_with_quizzes['picture'])
                                <img src="data:image/jpeg;base64,{{ $theme_with_quizzes['picture'] }}" class="image_theme">
                                @endif
                                <h3>
                                    <img src="/images/Picto_Score.png" width="30">
                                    @if ($theme_with_quizzes['score'] > $theme_with_quizzes['max_point'] / 2)
                                        <span style="color: green">{{ $theme_with_quizzes['score'] }} / {{ $theme_with_quizzes['max_point'] }}</span>
                                    @endif
                                    @if ($theme_with_quizzes['score'] == $theme_with_quizzes['max_point'] / 2)
                                        <span style="color: orange">{{ $theme_with_quizzes['score'] }} / {{ $theme_with_quizzes['max_point'] }}</span>
                                    @endif
                                    @if ($theme_with_quizzes['score'] < $theme_with_quizzes['max_point'] / 2)
                                        <span style="color: red"><b>{{ $theme_with_quizzes['score'] }} / {{ $theme_with_quizzes['max_point'] }}</b></span>
                                    @endif
                                </h3>
                                @if (count($theme_with_quizzes['quiz']) == 1)
                                <h4 style="color: darkgreen;"><b>{{ count($theme_with_quizzes['quiz']) }} question est disponible !</b></h4>
                                @else
                                <h4 style="color: darkgreen;"><b>{{ count($theme_with_quizzes['quiz']) }} questions sont disponibles !</b></h4>
                                @endif
                            </div>
                        </form>
                    @else
                        <div class="quiz">
                            <h2 style="margin-top: 0 !important;">{{ $theme_with_quizzes['theme'] }}</h2>
                            @if ($theme_with_quizzes['picture'])
                            <img src="data:image/jpeg;base64,{{ $theme_with_quizzes['picture'] }}" class="image_theme">
                            @endif
                            <h3>
                                <img src="/images/Picto_Score.png" width="30">
                                @if ($theme_with_quizzes['score'] > $theme_with_quizzes['max_point'] / 2)
                                <span style="color: green">{{ $theme_with_quizzes['score'] }} / {{ $theme_with_quizzes['max_point'] }}</span>
                                @endif
                                @if ($theme_with_quizzes['score'] == $theme_with_quizzes['max_point'] / 2)
                                <span style="color: orange">{{ $theme_with_quizzes['score'] }} / {{ $theme_with_quizzes['max_point'] }}</span>
                                @endif
                                @if ($theme_with_quizzes['score'] < $theme_with_quizzes['max_point'] / 2)
                                <span style="color: red"><b>{{ $theme_with_quizzes['score'] }} / {{ $theme_with_quizzes['max_point'] }}</b></span>
                                @endif
                            </h3>
                            <h4 style="padding: 0 10px;">Vous avez répondu à toutes les questions !</h4>
                        </div>
                    @endif
                @else
                <div class="quiz">
                    <h2 style="margin-top: 0 !important;">{{ $theme_with_quizzes['theme'] }}</h2>
                    @if ($theme_with_quizzes['picture'])
                    <img src="data:image/jpeg;base64,{{ $theme_with_quizzes['picture'] }}" class="image_theme">
                    @endif
                    <h4 style="margin-top: 30px;">Pas de question pour l'instant !</h4>
                </div>
            @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection