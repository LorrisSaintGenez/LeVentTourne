@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Quiz</div>

                <div class="panel-body">
                    @foreach ($quizzes as $quiz)
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                {{ $quiz->title }}
                            </h3>
                            <form method="GET" action="{{ route('edit', $quiz->id) }}">
                                <button type="submit" class="btn btn-info">
                                    Editer ce quiz
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-2">
                            <form method="GET" action="{{ route('create') }}">
                                <button type="submit" class="btn btn-info">
                                    Créer un quiz
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection