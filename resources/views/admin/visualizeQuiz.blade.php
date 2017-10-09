@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/backoffice/quiz') }}">Retour aux quiz</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Visualisation du quiz <b>{{ $quiz->title }}</b></div>
                <div class="panel-body">
                    <div class="col-md-12 text-center">
                        <h3>{{ $quiz->title }}</h3>
                    </div>

                    <div class="col-md-12 text-center">
                        <h3>Thème : {{ $quiz->theme }}</h3>
                    </div>

                    @if ($quiz->video != null)
                    <div class="col-md-12 text-center">
                        <iframe src="http://www.youtube.com/embed/{{$quiz->video}}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    @endif

                    @if ($quiz->picture != null)
                    <div class="col-md-12 text-center">
                        <img src="data:image/jpeg;base64,{{ $quiz->picture }}"/>
                    </div>
                    @endif

                    @if ($quiz->sound != null)
                    <div class="col-md-12 text-center">
                        <audio controls preload="metadata">
                            <source src="data:audio/mp3;base64, {{ $quiz->sound }}">
                        </audio>
                    </div>
                    @endif

                    <div class="col-md-12 text-center">
                        <div class="panel panel-info">
                            <h4>{{ $quiz->question }}</h4>
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="panel panel-primary">
                            <h4>{{ $quiz->answer_1 }}</h4>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="panel panel-primary">
                            <h4>{{ $quiz->answer_2 }}</h4>
                        </div>
                    </div>

                    @if ($quiz->answer_3 != null)
                    <div class="col-md-6 text-center">
                        <div class="panel panel-primary">
                            <h4>{{ $quiz->answer_3 }}</h4>
                        </div>
                    </div>
                    @endif
                    @if ($quiz->answer_4 != null)
                    <div class="col-md-6 text-center">
                        <div class="panel panel-primary">
                            <h4>{{ $quiz->answer_4 }}</h4>
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="{{ route('editQuiz', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                Editer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
