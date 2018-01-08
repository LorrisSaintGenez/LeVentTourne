@extends('layouts.app')
<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
@section('content')
<?php
function string_sanitize($s) {
    $result = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($s, ENT_QUOTES));
    return $result;
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Visualisation du quiz <b>{{ $quiz->title }}</b></div>
                <div class="panel-body">
                    <div id="timer-div" class="timer">
                        <img src="/images/Picto_Timer.png" width="30" />
                        <span id="timer">{{ $quiz->timer }}</span>
                    </div>
                    <div class="col-md-12 text-center">
                        <h3>{{ $quiz->title }}</h3>
                    </div>

                    <div class="col-md-12 text-center">
                        <h3>Thème : {{ $quiz->theme }}</h3>
                    </div>

                    @if ($quiz->video != null)
                    <div class="col-md-12 text-center">
                        <iframe src="http://www.youtube.com/embed/{{$quiz->video}}" width="100%" height="350" frameborder="0" allowfullscreen></iframe>
                    </div>
                    @endif

                    @if ($quiz->picture != null)
                    <div class="col-md-12 text-center">
                        <img src="data:image/jpeg;base64,{{ $quiz->picture }}"  class="image_theme"/>
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
                            {{ csrf_field() }}
                            <div class="panel panel-primary" onclick="answerQuiz('<?php echo string_sanitize($answer); ?>')" data-toggle="modal" data-target="#<?php echo string_sanitize($answer); ?>-modal">
                                <h4>{{ $answer }}</h4>
                            </div>
                        </div>

                        <div id="<?php echo string_sanitize($answer); ?>-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog">
                                <form id="<?php echo string_sanitize($answer); ?>-form" class="form-horizontal" method="POST" action="{{ route('quizAnswer', $quiz->id) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input id="{{ $answer }}" name="{{ $answer }}" type="hidden" value="{{ $answer }}">
                                    <input id="theme_id" name="theme_id" type="hidden" value="{{ $quiz->theme_id }}">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{ $quiz->question }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            @if ($answer == $quiz->good_answer)
                                            <h3 class="text-center" style="color:green;">Bonne réponse !</h3>
                                            @else
                                            <h3 class="text-center" style="color:red;"><b>Mauvaise réponse !</b></h3>
                                            @endif
                                            <br>
                                            <h4>{{ $quiz->explanation }}</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default" data-dismiss="modal" onclick="form_submit('<?php echo string_sanitize($answer); ?>-form')">>></button>
                                        </div>
                                     </div>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <div id="out_of_time" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog">

                            <form id="out_of_time-form" class="form-horizontal" method="POST" action="{{ route('quizAnswer', $quiz->id) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input id="{{ $answer }}" name="{{ $answer }}" type="hidden" value="{{ $answer }}">
                                <input id="theme_id" name="theme_id" type="hidden" value="{{ $quiz->theme_id }}">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ $quiz->question }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h3 class="text-center" style="color:red;"><b>Temps dépassé !</b></h3>
                                        <br>
                                        <h4>{{ $quiz->explanation }}</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default" data-dismiss="modal" onclick="form_submit('out_of_time-form')">>></button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                    <audio id="victory" hidden preload="auto" autoplay loop>
                        <source src="data:audio/mp3;base64, {{ $quiz->victory_sound }}">
                    </audio>
                    <audio id="defeat" hidden preload="auto" autoplay loop>
                        <source src="data:audio/mp3;base64, {{ $quiz->defeat_sound }}">
                    </audio>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var response = null;
    var victory = document.getElementById('victory');
    var defeat = document.getElementById('defeat');

    victory.defaultMuted = true;
    defeat.defaultMuted = true;

    var timerLimit = '{{ $quiz->timer }}';

    function form_submit(form_id) {
      document.forms[form_id].submit();
    }

    function setTimer() {
      if (timerLimit > 0) {
        timerLimit--;
        document.getElementById('timer').innerHTML = timerLimit;
      }
      else {
        $('#out_of_time').modal('show');
        answerQuiz("timer_ended");
      }

      if (timerLimit === 5) {
        document.getElementById('timer-div').setAttribute("class", "timer blink-img");
      }
    }

    var refreshIntervalId = setInterval(setTimer, 1000);

    function answerQuiz(answer) {
      clearInterval(refreshIntervalId);
      if (answer === '{{ $quiz->good_answer }}') {
        if ('{{ $quiz->victory_sound }}')
          triggerAudio(victory);
      }
      else {
        if ('{{ $quiz->defeat_sound }}')
          triggerAudio(defeat);

      }
      response = answer;
    }

    function triggerAudio(audio) {
      audio.pause();
      audio.currentTime = 0;
      audio.loop = false;
      audio.muted = false;
      audio.play();
    }
</script>
@endsection
