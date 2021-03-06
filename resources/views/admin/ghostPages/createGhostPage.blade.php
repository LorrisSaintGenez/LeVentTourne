@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/backoffice/pages') }}">Retour</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Création de page fantôme</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('ghostPageCreate') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Titre <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description" required autofocus>{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                            <label for="picture" class="col-md-4 control-label">Image</label>

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
                            <label for="video" class="col-md-4 control-label">Vidéo (lien YouTube)</label>

                            <div class="col-md-6">
                                <input id="video" class="form-control" name="video" value="{{ old('video') }}" autofocus>

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
                                    Créer la page
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