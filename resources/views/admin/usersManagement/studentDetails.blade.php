@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="max-height: 100vh;">

            <div class="row">
                <div class="col-md-6">
                    <a href="javascript:history.back()">Retour</a>
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
                                @if ($student->classroom)
                                Classe : <b>{{ $student->classroom->name }} - {{ $student->classroom->school->name }} ({{ $student->classroom->school->city }})</b>
                                @else
                                Rattaché à aucune classe
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
                                Nombre de points : <b>{{ $quiz_points }}</b> / <b>{{ $total_points }}</b>
                            </h4>
                        </div>

                        <div class="col-md-12">
                            <h4>
                                Création (aaaa/mm/jj hh:mm:ss) : <b>{{ $student->created_at }}</b>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection