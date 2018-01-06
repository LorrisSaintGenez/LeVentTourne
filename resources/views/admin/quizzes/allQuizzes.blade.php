@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('successQuiz'))
                <div class="alert alert-success">
                    {{ session('successQuiz') }}
                </div>
            @endif
            @if (session('successEdit'))
                <div class="alert alert-success">
                    {{ session('successEdit') }}
                </div>
            @endif
            @if (session('successDelete'))
                <div class="alert alert-success">
                    {{ session('successDelete') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Quiz</div>

                <div class="panel-body">

                    @foreach ($quizzes_by_theme as $quiz_by_theme)
                    <div class="title text-center"><h2>{{ $quiz_by_theme['theme'] }}</h2></div>
                    <div class="row">
                        @if (count($quiz_by_theme['quiz']) > 0)
                        @foreach ($quiz_by_theme['quiz'] as $quiz)
                            <div class="col-md-6" style="position: relative; margin-bottom: 20px;">
                                <h3 style="margin: 0; padding: 4px 0 0;">
                                    <b>{{ $quiz->title }}</b>
                                </h3>
                                @if ($quiz->picture)
                                <img src="/images/picture.svg" width="25" class="svg-icon svg-photo" style="cursor: default;">
                                @endif
                                @if ($quiz->sound)
                                <img src="/images/sound.svg" width="25" class="svg-icon svg-sound" style="cursor: default;">
                                @endif
                                @if ($quiz->video)
                                <img src="/images/video.svg" width="25" class="svg-icon svg-video" style="cursor: default;">
                                @endif
                                <a href="{{ route('quizEdit', $quiz->id) }}" type="submit">
                                    <img src="/images/edit.svg" width="25" class="svg-icon svg-edit">
                                </a>
                                <a href="{{ route('quizVisualize', $quiz->id) }}" type="submit">
                                    <img src="/images/eye.svg" width="25" class="svg-icon svg-eye">
                                </a>
                            </div>
                        @endforeach
                        @else
                        <h3 class="text-center"><i>Pas de quiz crée pour ce thème</i></h3>
                        @endif
                    </div>
                    <hr>
                    @endforeach

                    <div class="row">
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('quizCreation') }}">
                                <button type="submit" class="btn btn-primary">
                                    Créer un quiz
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection