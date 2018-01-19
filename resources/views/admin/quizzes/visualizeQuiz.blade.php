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
                    <div class="col-md-12">
                        <div class="col-md-12 text-center">
                            <h3>{{ $quiz->title }}</h3>
                        </div>

                        <div class="col-md-12 text-center">
                            <h3>Thème : {{ $quiz->theme }}</h3>
                        </div>

                        @if ($quiz->video != null)
                        <div class="col-md-12 text-center">
                            <iframe src="https://www.youtube.com/embed/{{$quiz->video}}" width="100%" height="350" frameborder="0" allowfullscreen></iframe>
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
                                <h4 style="white-space: pre-wrap;">{{ $quiz->question }}</h4>
                            </div>
                        </div>
                        @foreach ($quiz->answers as $answer)
                        <div class="col-md-6 col-xs-6 text-center">
                            @if ($answer == $quiz->good_answer)
                            <div class="panel panel-success">
                                <h4>{{ $answer }}</h4>
                            </div>
                            @else
                            <div class="panel panel-danger">
                                <h4>{{ $answer }}</h4>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group col-md-12">
                        <div class="col-md-2">
                            <a href="{{ route('quizEdit', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                Editer
                            </a>
                        </div>
                        <div class="col-md-2">
                            <form method="POST" action="{{ route('quizDelete', $quiz->id) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" class="btn btn-lg btn-danger">
                                    Supprimer
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
