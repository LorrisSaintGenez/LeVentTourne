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
                <div class="panel-heading">Détail de votre compte</div>
                <div class="panel-body">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h4>
                                Nom/Prénom/Pseudo : <b>{{ $teacher->name }}</b>
                            </h4>
                        </div>
                        <div class="col-md-12">
                            <h4>
                                Identifiant : <b>{{ $teacher->email }}</b>
                            </h4>
                        </div>
                        <div class="col-md-12">
                            <h4>
                                Voir vos classes
                            </h4>
                        </div>
                        <div class="col-md-12">
                            <h4>
                                {{ $school->name }}
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ url('teacher/edit') }}" type="submit" class="btn btn-lg btn-info">
                            Editer le profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection