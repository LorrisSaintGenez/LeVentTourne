@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('noTheme'))
            <div class="alert alert-danger">
                {{ session('noTheme') }}
            </div>
            @endif
            @if (session('successTheme'))
            <div class="alert alert-success">
                {{ session('successTheme') }}
            </div>
            @endif

            <div class="col-md-5 col-md-push-7">
                <div class="panel panel-default">
                    <div class="panel-heading">Création d'un thème</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('themeCreate') }}" enctype="multipart/form-data">
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
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Créer le thème
                                        </button>
                                    </div>
                                </div>

                            <div>
                                <span><span style="color: red">*</span> Les champs avec une étoile sont obligatoires.</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-md-pull-5">
            @if ($themes->count() > 0)
                @foreach ($themes as $theme)
                    <div class="col-md-6">
                        <div class="admin_theme">
                            <h2>
                                {{ $theme->title }}
                            </h2>
                            @if ($theme->picture)
                            <img src="data:image/jpeg;base64,{{ $theme->picture }}" class="image_theme">
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
            <h2 class="text-center text-danger">Aucun thème disponible</h2>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection