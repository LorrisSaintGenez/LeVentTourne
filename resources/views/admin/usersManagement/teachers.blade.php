@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="max-height: 100vh;">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/backoffice/users') }}">Retour</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Liste des professeurs</div>
                <div class="panel-body">
                    @foreach ($teachers as $teacher)
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h4>
                                {{ $teacher->name }}
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <h4>
                                {{ $teacher->created_at }}
                            </h4>
                        </div>
                        @if (count($teacher->classrooms) == 0)
                        <div class="col-md-4">
                            <h4>
                                Rattaché à aucune classe.
                            </h4>
                        </div>
                        @else
                        <div class="col-md-4">
                            <a href="{{ route('classesByTeacher', $teacher->teacher_id) }}" type="submit">
                                <h4>Voir classes</h4>
                            </a>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection