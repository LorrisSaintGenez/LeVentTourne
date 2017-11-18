@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Explication du quiz <b>{{ $quiz->title }}</b></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-12 text-center">
                            <h1>{{ $quiz->title }}</h1>
                            <h2>{{ $quiz->question }}</h2>
                        </div>
                        <div class="col-md-12">
                            <h3>Explication : <h4>{{ $quiz->explanation }}</h4></h3>
                        </div>
                    </div>
                    <form class="form-horizontal" method="GET" action="{{ route('getAllQuizzesStudent') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">
                                Ok, j'ai compris !
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection