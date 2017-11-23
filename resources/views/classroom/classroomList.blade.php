@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="max-height: 100vh;">

            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/teacher') }}">Retour</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Classes de <b>{{ $teacher->name }}</b></div>
                <div class="panel-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h4>
                                <b>Classe</b>
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <h4>
                                <b>Ecole</b>
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <h4>
                                <b>Action</b>
                            </h4>
                        </div>
                    </div>
                    @if (!$classrooms)
                    <h2 class="text-center text-danger">Vous n'êtes professeur d'aucune classe.</h2>
                    @endif
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
                            @if ($classroom->classStudents->count() > 0)
                            <a href="{{ route('visualizeMyClassroom', $classroom->id) }}" type="submit">
                                <h4>Liste des élèves de la classe ({{$classroom->classStudents->count()}})</h4>
                            </a>
                            @else
                                <h4 style="color: red;">Aucune élève dans cette classe</h4>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection