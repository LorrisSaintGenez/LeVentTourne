@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Quiz</div>

                <div class="panel-body">

                    <div class="title">Quiz sur l'eau</div>

                    @foreach ($quizzes_water as $quiz)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3 text-center">
                                <h3>
                                    {{ $quiz->title }}
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
                            <div class="col-md-3 text-center" style="margin-top: 10px">
                                <a href="{{ route('edit', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Editer
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    @endforeach

                    <div class="title">Quiz sur la nature</div>

                    @foreach ($quizzes_nature as $quiz)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3 text-center">
                                <h3>
                                    {{ $quiz->title }}
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
                            <div class="col-md-3 text-center" style="margin-top: 10px">
                                <a href="{{ route('edit', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Editer
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    @endforeach

                    <div class="title">Quiz sur la nutrition</div>

                    @foreach ($quizzes_food as $quiz)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3 text-center">
                                <h3>
                                    {{ $quiz->title }}
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
                            <div class="col-md-3 text-center" style="margin-top: 10px">
                                <a href="{{ route('edit', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Editer
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    @endforeach

                    <div class="title">Quiz sur le tri des déchets</div>

                    @foreach ($quizzes_waste as $quiz)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3 text-center">
                                <h3>
                                    {{ $quiz->title }}
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
                            <div class="col-md-3 text-center" style="margin-top: 10px">
                                <a href="{{ route('edit', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Editer
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    @endforeach

                    <br>

                    <div class="row">
                        <div class="col-md-2">
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
    </div>
</div>
@endsection