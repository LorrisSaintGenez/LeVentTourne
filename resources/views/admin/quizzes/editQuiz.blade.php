@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/backoffice/quiz') }}">Retour aux quiz</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Edition du quiz <b>{{ $quiz->title }}</b></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('quizUpdate') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="hidden">
                            <input type="hidden" id="id" name="id" value="{{ $quiz->id }}">
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Titre <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $quiz->title }}" required autofocus>

                                @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('theme') ? ' has-error' : '' }}">
                            <label for="theme" class="col-md-4 control-label">Thème <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <select id="theme" name="theme" required autofocus>
                                    @foreach ($themes as $theme)
                                        @if ($quiz->theme == $theme->id)
                                            <option selected value="<?php echo htmlentities($theme->title); ?>">{{ $theme->title }}</option>
                                        @else
                                            <option value="<?php echo htmlentities($theme->title); ?>">{{ $theme->title }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('theme'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('theme') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Question <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <textarea style="resize: vertical" id="question" class="form-control" name="question" required autofocus >{{ $quiz->question }}</textarea>

                                @if ($errors->has('question'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('explanation') ? ' has-error' : '' }}">
                            <label for="explanation" class="col-md-4 control-label">Explications <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <textarea style="resize: vertical" id="explanation" class="form-control" name="explanation" required autofocus >{{ $quiz->explanation }}</textarea>

                                @if ($errors->has('explanation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('explanation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('good_answer') ? ' has-error' : '' }}">
                            <label for="good_answer" class="col-md-4 control-label">Bonne réponse <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="good_answer" type="text" class="form-control" name="good_answer" value="{{ $quiz->good_answer }}" required autofocus>

                                @if ($errors->has('good_answer'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('good_answer') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('answer_2') ? ' has-error' : '' }}">
                            <label for="answer_2" class="col-md-4 control-label">Réponse 2 <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="answer_2" type="text" class="form-control" name="answer_2" value="{{ $quiz->answers[1] }}" required autofocus>

                                @if ($errors->has('answer_2'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('answer_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('answer_3') ? ' has-error' : '' }}">
                            <label for="answer_3" class="col-md-4 control-label">Réponse 3</label>

                            <div class="col-md-6">
                                <input id="answer_3" type="text" class="form-control" name="answer_3" value="<?php if (array_count_values($quiz->answers) > 2) echo $quiz->answers[2];?>" autofocus>

                                @if ($errors->has('answer_3'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('answer_3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('answer_4') ? ' has-error' : '' }}">
                            <label for="answer_4" class="col-md-4 control-label">Réponse 4</label>

                            <div class="col-md-6">
                                <input id="answer_4" type="text" class="form-control" name="answer_4" value="<?php if (array_count_values($quiz->answers) > 3) echo $quiz->answers[3];?>" autofocus>

                                @if ($errors->has('answer_4'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('answer_4') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('point') ? ' has-error' : '' }}">
                            <label for="point" class="col-md-4 control-label">Nombre de points <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="point" type="number" class="form-control" name="point" value="{{ $quiz->point }}" required autofocus>

                                @if ($errors->has('point'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('point') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('timer') ? ' has-error' : '' }}">
                            <label for="timer" class="col-md-4 control-label">Temps de réponse (sec) <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="timer" min="1" type="number" class="form-control" name="timer" value="{{ $quiz->timer }}" required autofocus>

                                @if ($errors->has('timer'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('timer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                            <label for="picture" class="col-md-4 control-label">Photo</label>

                            <div class="col-md-6">
                                @if ($quiz->picture != null)
                                    <img src="data:image/jpeg;base64,{{ $quiz->picture }}"/>
                                @endif

                                <input type="file" id="picture" class="form-control" name="picture" autofocus>

                                @if ($errors->has('picture'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('picture') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sound') ? ' has-error' : '' }}">
                            <label for="sound" class="col-md-4 control-label">Son</label>

                            <div class="col-md-6">
                                @if ($quiz->sound != null)
                                <audio controls preload="metadata">
                                    <source src="data:audio/mp3;base64, {{ $quiz->sound }}">
                                </audio>
                                @endif

                                <input type="file" id="sound" class="form-control" name="sound" autofocus>

                                @if ($errors->has('sound'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('sound') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('video') ? ' has-error' : '' }}">
                            <label for="video" class="col-md-4 control-label">Vidéo (lien YouTube)</label>

                            <div class="col-md-6">
                                @if ($quiz->video != null)
                                    <div class="container">
                                        <iframe src="https://www.youtube.com/embed/{{$quiz->video}}" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <input id="video" class="form-control" name="video" value="https://www.youtube.com/watch?v={{ $quiz->video }}" autofocus>
                                @else
                                    <input id="video" class="form-control" name="video" autofocus>
                                @endif


                                @if ($errors->has('video'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('video') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('victory_sound') ? ' has-error' : '' }}">
                            <label for="victory_sound" class="col-md-4 control-label">Son de bonne réponse</label>

                            <div class="col-md-6">
                                @if ($quiz->victory_sound != null)
                                <audio controls preload="metadata">
                                    <source src="data:audio/mp3;base64, {{ $quiz->victory_sound }}">
                                </audio>
                                @endif

                                <input type="file" id="victory_sound" class="form-control" name="victory_sound" autofocus>

                                @if ($errors->has('victory_sound'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('victory_sound') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('defeat_sound') ? ' has-error' : '' }}">
                            <label for="defeat_sound" class="col-md-4 control-label">Son de mauvaise réponse</label>

                            <div class="col-md-6">
                                @if ($quiz->defeat_sound != null)
                                <audio controls preload="metadata">
                                    <source src="data:audio/mp3;base64, {{ $quiz->defeat_sound }}">
                                </audio>
                                @endif
                                <input type="file" id="defeat_sound" class="form-control" name="defeat_sound" autofocus>

                                @if ($errors->has('defeat_sound'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('defeat_sound') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Editer le quiz
                                </button>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <span><span style="color: red">*</span> Les champs avec une étoile sont obligatoires.</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
