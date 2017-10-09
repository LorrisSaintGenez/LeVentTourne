@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Création de quiz</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Titre <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('theme') ? ' has-error' : '' }}">
                            <label for="theme" class="col-md-4 control-label">Theme <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <select id="theme" name="theme" required autofocus>
                                    <option value="water">Eau</option>
                                    <option value="nature">Nature</option>
                                    <option value="food">Nutrition</option>
                                    <option value="waste">Tri des déchets</option>
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
                                <textarea style="resize: vertical" id="question" type="text" class="form-control" name="question" value="{{ old('question') }}" required autofocus ></textarea>

                                @if ($errors->has('question'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('answer_1') ? ' has-error' : '' }}">
                            <label for="answer_1" class="col-md-4 control-label">Réponse 1 <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="answer_1" type="text" class="form-control" name="answer_1" value="{{ old('answer_1') }}" required autofocus>

                                @if ($errors->has('answer_1'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('answer_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('answer_2') ? ' has-error' : '' }}">
                            <label for="answer_2" class="col-md-4 control-label">Réponse 2 <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="answer_2" type="text" class="form-control" name="answer_2" value="{{ old('answer_2') }}" required autofocus>

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
                                <input id="answer_3" type="text" class="form-control" name="answer_3" value="{{ old('answer_3') }}" autofocus>

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
                                <input id="answer_4" type="text" class="form-control" name="answer_4" value="{{ old('answer_4') }}" autofocus>

                                @if ($errors->has('answer_4'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('answer_4') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('solution') ? ' has-error' : '' }}">
                            <label for="solution" class="col-md-4 control-label">Solution <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <select id="solution" name="solution" required autofocus>
                                    <option value="1">Réponse 1</option>
                                    <option value="2">Réponse 2</option>
                                    <option value="3">Réponse 3</option>
                                    <option value="4">Réponse 4</option>
                                </select>

                                @if ($errors->has('solution'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('solution') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('point') ? ' has-error' : '' }}">
                            <label for="point" class="col-md-4 control-label">Nombre de points <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="point" type="number" class="form-control" name="point" value="{{ old('point') }}" required autofocus>

                                @if ($errors->has('point'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('point') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                            <label for="picture" class="col-md-4 control-label">Photo</label>

                            <div class="col-md-6">
                                <input type="file" id="picture" class="form-control" name="picture" value="{{ old('picture') }}" autofocus>

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
                                <input type="file" id="sound" class="form-control" name="sound" value="{{ old('sound') }}" autofocus>

                                @if ($errors->has('sound'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('sound') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('video') ? ' has-error' : '' }}">
                            <label for="video" class="col-md-4 control-label">Vidéo</label>

                            <div class="col-md-6">
                                <input type="text" id="video" class="form-control" name="video" value="{{ old('video') }}" autofocus>

                                @if ($errors->has('video'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('video') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Créer le quiz
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
