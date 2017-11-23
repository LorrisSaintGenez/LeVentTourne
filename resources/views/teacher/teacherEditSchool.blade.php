@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('teacher') }}">Retour à l'accueil</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Rejoindre une école</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('teacherUpdateSchool') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('school') ? ' has-error' : '' }}">
                            <label for="school" class="col-md-4 control-label">Ecole <span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <select id="school" name="school" required autofocus>
                                    @foreach ($schools as $school)
                                    @if ($teacher->school_id == $school->id)
                                    <option selected value={{$school->id}}>{{ $school->name }} - {{ $school->city }}</option>
                                    @else
                                    <option value={{$school->id}}>{{ $school->name }} - {{ $school->city }}</option>
                                    @endif
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
                                    Choisir l'école
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
