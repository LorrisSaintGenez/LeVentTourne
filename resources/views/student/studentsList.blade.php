@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="max-height: 100vh;">

            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/teacher/classes') }}">Retour</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Liste des élèves</div>
                <div class="panel-body">
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
                            <h4>
                                {{ $user->classroom->name }} - {{ $user->classroom->school->name }}
                            </h4>
                        </div>
                        <div class="col-md-3">
                            <h4>
                                {{ $user->created_at }}
                            </h4>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('visualizeClassStudent', $user->id) }}" type="submit">
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