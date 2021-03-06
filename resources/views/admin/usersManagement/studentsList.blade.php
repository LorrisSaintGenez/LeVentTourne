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
                <div class="panel-heading">Liste des élèves</div>
                <div class="panel-body">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <h4>
                                <b>Eleve</b>
                            </h4>
                        </div>
                        <div class="col-md-3">
                            <h4>
                                <b>Classe</b>
                            </h4>
                        </div>
                        <div class="col-md-3">
                            <h4>
                                <b>Date de création</b>
                            </h4>
                        </div>
                        <div class="col-md-3">
                            <h4>
                                <b>Action</b>
                            </h4>
                        </div>
                    </div>
                    @if (!$users)
                    <h2 class="text-center text-danger">Aucun élève</h2>
                    @endif
                    @foreach ($users as $user)
                    <div class="row text-center">
                        <div class="col-md-3">
                            <h4>
                                {{ $user->name }}
                            </h4>
                        </div>
                        <div class="col-md-3">
                            @if ($user->classroom != null)
                            <h4>
                                {{ $user->classroom->name }} - {{ $user->classroom->school->name }}
                            </h4>
                            @else
                            <h4 style="color: red;">
                                Pas de classe
                            </h4>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <h4>
                                {{ $user->created_at }}
                            </h4>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('visualizeStudent', $user->id) }}" type="submit">
                                <h4>Fiche élève</h4>
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