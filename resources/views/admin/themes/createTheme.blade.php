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
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/backoffice') }}">Retour</a>
                </div>
            </div>
            <div class="col-md-4 col-md-push-8">
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

            <div class="col-md-8 col-md-pull-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Thèmes disponibles</div>
                    <div class="panel-body">
                        @if ($themes->count() > 0)
                        @foreach ($themes as $theme)
                        <h2>{{ $theme->title }}</h2>
                        <hr>
                        @endforeach
                        @else
                        <h2 class="text-center text-danger">Aucun thème disponible</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection