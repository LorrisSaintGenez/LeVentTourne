@extends('layouts.app')

<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">

@section('content')
<div class="container">   <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/quiz') }}">Retour aux quiz</a>
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
                            <h4 style="white-space: pre-wrap;">{{ $quiz->question }}</h4>
                        </div>
                    </div>
                    <form name="answer_1" id="answer_1" class="form-horizontal" method="POST" action="{{ route('answerQuiz', $quiz->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-6 text-center" onClick="document.forms['answer_1'].submit();">
                            <div class="panel panel-primary">
                                <input id="answer_1" name="answer_1" type="hidden" value="{{ $quiz->answer_1 }}">
                                <h4>{{ $quiz->answer_1 }}</h4>
                            </div>
                        </div>
                    </form>

                    <form name="answer_2" id="answer_2" class="form-horizontal" method="POST" action="{{ route('answerQuiz', $quiz->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-6 text-center" onClick="document.forms['answer_2'].submit();">
                            <div class="panel panel-primary">
                                <input id="answer_2" name="answer_2" type="hidden" value="{{ $quiz->answer_2 }}">
                                <h4>{{ $quiz->answer_2 }}</h4>
                            </div>
                        </div>
                    </form>

                    <form name="answer_3" id="answer_3" class="form-horizontal" method="POST" action="{{ route('answerQuiz', $quiz->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($quiz->answer_3 != null)
                        <div class="col-md-6 text-center" onClick="document.forms['answer_3'].submit();">
                            <div class="panel panel-primary">
                                <input id="answer_3" name="answer_3" type="hidden" value="{{ $quiz->answer_3 }}">
                                <h4>{{ $quiz->answer_3 }}</h4>
                            </div>
                        </div>
                        @endif
                    </form>

                    <form name="answer_4" id="answer_4" class="form-horizontal" method="POST" action="{{ route('answerQuiz', $quiz->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($quiz->answer_4 != null)
                        <div class="col-md-6 text-center" onClick="document.forms['answer_4'].submit();">
                            <div class="panel panel-primary">
                                <input id="answer_4" name="answer_4" type="hidden" value="{{ $quiz->answer_4 }}">
                                <h4>{{ $quiz->answer_4 }}</h4>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
