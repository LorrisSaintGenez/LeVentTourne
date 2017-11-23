@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('student') }}">Retour</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Edition de votre profil</b></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('studentUpdate') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="hidden">
                            <input type="hidden" id="id" name="id" value="{{ $student->id }}">
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nom/Prénom/Pseudo <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $student->name }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Adresse email <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="email" class="form-control" name="email" required autofocus value="{{ $student->email }}"/>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('classroom_id') ? ' has-error' : '' }}">
                            <label for="classroom_id" class="col-md-4 control-label">Classe <span style="color: red">*</span></label>
                            <div class="col-md-6">
                                <select id="classroom_id" class="form-control" name="classroom_id">
                                    @foreach($classrooms as $classroom)
                                    @if ($student->classroom->id == $classroom->id)
                                        <option selected value="{{$classroom->id}}">{{$classroom->name}} - {{$classroom->school->name}} ({{$classroom->school->city}})</option>
                                    @else
                                        <option value="{{$classroom->id}}">{{$classroom->name}} - {{$classroom->school->name}} ({{$classroom->school->city}})</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Valider
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