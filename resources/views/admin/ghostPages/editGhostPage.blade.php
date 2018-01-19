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
                <div class="panel-heading">Edition de page fantôme <b>{{ $page->title }}</b></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('ghostPageEdit') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="hidden">
                            <input type="hidden" id="id" name="id" value="{{ $page->id }}">
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Titre <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $page->title }}" required autofocus>

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
                                <textarea id="description" class="form-control" name="description" required autofocus>{{ $page->description }}</textarea>

                                @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                            <label for="picture" class="col-md-4 control-label">Photo</label>

                            <div class="col-md-6">
                                @if ($page->picture != null)
                                <img src="data:image/jpeg;base64,{{ $page->picture }}"/>
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
                                @if ($page->sound != null)
                                <audio controls preload="metadata">
                                    <source src="data:audio/mp3;base64, {{ $page->sound }}">
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
                                @if ($page->video != null)
                                <div class="container">
                                    <iframe src="https://www.youtube.com/embed/{{$page->video}}" frameborder="0" allowfullscreen></iframe>
                                </div>
                                <input id="video" class="form-control" name="video" value="https://www.youtube.com/watch?v={{ $page->video }}" autofocus>
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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Editer la page
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