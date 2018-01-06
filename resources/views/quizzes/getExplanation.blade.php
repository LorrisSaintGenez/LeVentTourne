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
                        <div class="col-md-12 text-center">
                        @if ($isSuccess)
                            <h3 style="color:green;">Bonne réponse ! :D</h3>
                        @else
                            <h3 style="color:red;"><b>Mauvaise réponse ! :(</b></h3>
                        @endif
                        </div>
                        <div class="col-md-12">
                            <h3><b>Explication</b> : {{ $quiz->explanation }}</h3>
                        </div>
                    </div>
                    <form class="form-horizontal" method="GET" action="{{ route('quizGet', $quiz->theme_id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">
                                Question suivante !
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection