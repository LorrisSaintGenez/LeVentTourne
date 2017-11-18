@extends('layouts.app')
<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
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
                    @foreach ($quiz->answers as $answer)
                    <form name="{{ $answer }}" id="{{ $answer }}" class="form-horizontal" method="POST" action="{{ route('quizAnswer', $quiz->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="col-md-6 text-center" onClick="answerQuiz('{{ $answer }}')">
                            <div class="panel panel-primary">
                                <input id="{{ $answer }}" name="{{ $answer }}" type="hidden" value="{{ $answer }}">
                                <h4>{{ $answer }}</h4>
                            </div>
                        </div>
                    </form>
                    @endforeach

                    <audio id="victory" hidden preload="auto" onended="onAudioEnded()" autoplay>
                        <source src="data:audio/mp3;base64, {{ $quiz->victory_sound }}">
                    </audio>
                    <audio id="defeat" hidden preload="auto" onended="onAudioEnded()" autoplay>
                        <source src="data:audio/mp3;base64, {{ $quiz->defeat_sound }}">
                    </audio>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var response = null;

    document.getElementById('victory').defaultMuted = true;
    document.getElementById('defeat').defaultMuted = true;

    function answerQuiz(answer) {
      if (answer === '{{ $quiz->good_answer }}') {
        document.getElementById('victory').muted = false;
        document.getElementById('victory').play();
      }
      else {
        document.getElementById('defeat').muted = false;
        document.getElementById('defeat').play();
      }
      response = answer;
    }

    function onAudioEnded() {
      if (response !== null)
        document.forms[response].submit();
    }
</script>
@endsection
