@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/backoffice/pages') }}">Retour</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Visualisation de la page <b>{{ $page->title }}</b></div>
                <div class="panel-body">
                    <div class="col-md-12 text-center">
                        <h3>{{ $page->title }}</h3>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4>{{ $page->description }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection