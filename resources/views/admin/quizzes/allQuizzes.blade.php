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
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/backoffice') }}">Retour</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Quiz</div>

                <div class="panel-body">
                    @foreach ($quizzes_by_theme as $quiz_by_theme)
                        <div class="title"><h2>{{ $quiz_by_theme['theme'] }}</h2></div>

                        @foreach ($quiz_by_theme['quiz'] as $quiz)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-2 text-center">
                                        <h3>
                                            <b>{{ $quiz->title }}</b>
                                        </h3>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <h3>
                                            <?php if ($quiz->picture) echo "Photo" ?>
                                        </h3>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <h3>
                                            <?php if ($quiz->sound) echo "Audio" ?>
                                        </h3>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <h3>
                                            <?php if ($quiz->video) echo "Vidéo" ?>
                                        </h3>
                                    </div>
                                    <div class="col-md-2 text-center" style="margin-top: 10px">
                                        <a href="{{ route('quizEdit', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                            Editer
                                        </a>
                                    </div>
                                    <div class="col-md-2 text-center" style="margin-top: 10px">
                                        <a href="{{ route('quizVisualize', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                            Visualiser
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                        @endforeach
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