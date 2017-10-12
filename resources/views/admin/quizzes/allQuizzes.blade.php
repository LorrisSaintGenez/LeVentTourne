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
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/backoffice') }}">Retour</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Quiz</div>

                <div class="panel-body">

                    @if (count($quizzes_water) > 0)
                    <div class="title"><h2>Quiz sur l'eau</h2></div>

                    @foreach ($quizzes_water as $quiz)
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
                                <a href="{{ route('editQuiz', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Editer
                                </a>
                            </div>
                            <div class="col-md-2 text-center" style="margin-top: 10px">
                                <a href="{{ route('visualizeQuiz', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Visualiser
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    @endforeach
                    @endif

                    @if (count($quizzes_nature) > 0)
                    <div class="title"><h2>Quiz sur la nature</h2></div>

                    @foreach ($quizzes_nature as $quiz)
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
                                <a href="{{ route('editQuiz', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Editer
                                </a>
                            </div>
                            <div class="col-md-2 text-center" style="margin-top: 10px">
                                <a href="{{ route('visualizeQuiz', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Visualiser
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    @endforeach
                    @endif

                    @if (count($quizzes_food) > 0)
                    <div class="title"><h2>Quiz sur la nutrition</h2></div>

                    @foreach ($quizzes_food as $quiz)
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
                                <a href="{{ route('editQuiz', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Editer
                                </a>
                            </div>
                            <div class="col-md-2 text-center" style="margin-top: 10px">
                                <a href="{{ route('visualizeQuiz', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Visualiser
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    @endforeach
                    @endif

                    @if (count($quizzes_waste) > 0)
                    <div class="title"><h2>Quiz sur le tri des déchets</h2></div>

                    @foreach ($quizzes_waste as $quiz)
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
                                <a href="{{ route('editQuiz', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Editer
                                </a>
                            </div>
                            <div class="col-md-2 text-center" style="margin-top: 10px">
                                <a href="{{ route('visualizeQuiz', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Visualiser
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    @endforeach
                    @endif

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form method="GET" action="{{ route('create') }}">
                        <button type="submit" class="btn btn-primary">
                            Créer un quiz
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection