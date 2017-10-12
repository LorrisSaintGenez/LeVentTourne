@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="max-height: 100vh;">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/backoffice') }}">Retour</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Utilisateurs</div>
                <div class="panel-body">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <a href="{{ route('studentsIndex') }}" type="submit">
                                <h4>Voir les élèves</h4>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('teachersIndex') }}" type="submit">
                                <h4>Voir les professeurs</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection