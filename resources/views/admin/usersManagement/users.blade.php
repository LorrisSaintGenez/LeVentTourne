@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Utilisateurs</div>
                <div class="panel-body">
                    @foreach ($users as $user)
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3>
                                {{ $user->name }}
                            </h3>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>