@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            @if (session('successEdit'))
            <div class="alert alert-success">
                {{ session('successEdit') }}
            </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/') }}">Retour à l'accueil</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Détail de l'élève {{ $student->name }}</b></div>
                <div class="panel-body">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h4>
                                Nom/Prénom/Pseudo : <b>{{ $student->name }}</b>
                            </h4>
                        </div>
                        <div class="col-md-12">
                            <h4>
                                Identifiant : <b>{{ $student->email }}</b>
                            </h4>
                        </div>
                        <div class="col-md-12">
                            <h4>
                                @if ($student->teacher != null)
                                Professeur : <b>{{ $student->teacher->name }}</b>
                                @else
                                Rattaché à aucun professeur
                                @endif
                            </h4>
                        </div>
                        <div class="col-md-12">
                            <h4>
                                Nombre de quiz réussis : <b>{{ $quizzes_done->count() }}</b> / <b>{{ $quizzes->count() }}</b>
                            </h4>
                        </div>
                        <div class="col-md-12">
                            <h4>
                                Nombre de points : <b>{{ $quiz_points }} / <b>{{ $total_points }}</b></b>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ url('student/edit') }}" type="submit" class="btn btn-lg btn-info">
                            Editer le profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection