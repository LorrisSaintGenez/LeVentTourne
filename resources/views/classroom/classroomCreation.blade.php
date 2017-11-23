@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/') }}">Retour à l'accueil</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Création d'une classe</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('classroomCreate') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nom de la classe <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('school') ? ' has-error' : '' }}">
                            <label for="school" class="col-md-4 control-label">Ecole <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <select id="school" name="school" required autofocus>
                                    @foreach ($schools as $school)
                                    <option value={{$school->id}}>{{ $school->name }} - {{ $school->city }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('school'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('school') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Créer la classe
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
