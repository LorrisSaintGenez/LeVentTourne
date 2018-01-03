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
            @foreach ($quizzes_by_theme as $quiz_by_theme)
            <div class="col-lg-4 col-md-6">
                <div class="quiz">
                    <div class="title">
                        <h2>{{ $quiz_by_theme['theme'] }}</h2>
                    </div>
                    @if ($quiz_by_theme['max_point'] == 0)
                        <h3>Pas de question pour l'instant !</h3>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection