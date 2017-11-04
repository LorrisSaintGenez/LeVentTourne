@extends('layouts.material')
@section('content')
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid">
        @if (session('successQuiz'))
        <script>
          alert("{{session('successQuiz')}}")
        </script>
        @endif
        @if (session('failQuiz'))
        <script>
          alert("{{session('failQuiz')}}")
        </script>
        @endif
        <div class="demo-cards mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-grid">
            @foreach ($quizzes as $quiz)
            @if (!$quiz->exists)
            <div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop">
                <div class="mdl-card__title mdl-card--expand mdl-color--teal-300">
                    <h2 class="mdl-card__title-text">{{ $quiz->title }}</h2>
                </div>
                <div class="mdl-card__supporting-text mdl-color-text--grey-600">
                    Thème : {{ $quiz->theme }}
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a href="{{ route('getQuiz', $quiz->id) }}" class="mdl-button mdl-js-button mdl-js-ripple-effect">Répondre</a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</main>
@endsection