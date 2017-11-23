@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="max-height: 100vh;">

            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/backoffice/users/') }}">Retour</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Classes de <b>{{ $teacher->name }}</b></div>
                <div class="panel-body">
                    @foreach ($classrooms as $classroom)
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h4>
                                {{ $classroom->name }}
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <h4>
                                {{ $classroom->school->name }}
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('visualizeClassroom', $classroom->id) }}" type="submit">
                                <h4>Liste des élèves de la classe</h4>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection