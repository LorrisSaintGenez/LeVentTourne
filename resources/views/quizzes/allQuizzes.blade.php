@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('successQuiz'))
                <div class="alert alert-success">
                    {{ session('successQuiz') }}
                </div>
            @endif
            @if (session('failQuiz'))
            <div class="alert alert-danger">
                {{ session('failQuiz') }}
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/') }}">Retour à l'accueil</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Quiz disponibles</div>

                <div class="panel-body">

                    @foreach ($quizzes as $quiz)
                    <div class="row">
                        <div class="col-md-12">
                            @if (!$quiz->exists)
                                <div class="col-md-4">
                                    <h3>
                                        <b>{{ $quiz->title }}</b>
                                    </h3>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h3>
                                        {{ $quiz->theme }}
                                    </h3>
                                </div>
                                <div class="col-md-4 text-center" style="margin-top: 10px">
                                    <a href="{{ route('getQuiz', $quiz->id) }}" type="submit" class="btn btn-lg btn-info">
                                        Répondre >
                                    </a>
                                </div>
                            @else
                                <div class="col-md-4">
                                    <h3>
                                        <b>{{ $quiz->title }}</b>
                                    </h3>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h3>
                                        {{ $quiz->theme }}
                                    </h3>
                                </div>
                                <div class="col-md-4 text-center">
                                    @if ($quiz->success)
                                    <h3 style="color: green;">Réussi</h3>
                                    @else
                                    <h3 style="color: red;">Echoué</h3>
                                    @endif
                                </div>
                            @endif

                        </div>
                    </div>
                    <hr/>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection