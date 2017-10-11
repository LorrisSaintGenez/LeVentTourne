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
                <div class="panel-heading">Liste des élèves</div>
                <div class="panel-body">
                    @foreach ($users as $user)
                    <div class="row text-center">
                        <div class="col-md-3">
                            <h4>
                                {{ $user->name }}
                            </h4>
                        </div>
                        <div class="col-md-3">
                            @if ($user->teacher == null)
                            <h4 style="color: red;">
                                Pas de professeur
                            </h4>
                            @else
                            <h4>
                                {{ $user->teacher }}
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
                                <h4>Editer</h4>
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