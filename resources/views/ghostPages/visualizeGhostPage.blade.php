@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Visualisation de la page <b>{{ $page->title }}</b></div>
                <div class="panel-body">
                    <div class="col-md-12 text-center">
                        <h3>{{ $page->title }}</h3>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4 style="white-space: pre-wrap;">{{ $page->description }}</h4>
                    </div>

                    @if ($page->video != null)
                    <div class="col-md-12 text-center">
                        <iframe src="https://www.youtube.com/embed/{{$page->video}}" width="100%" frameborder="0" allowfullscreen></iframe>
                    </div>
                    @endif

                    @if ($page->picture != null)
                    <div class="col-md-12 text-center">
                        <img style="width: 100%;" src="data:image/jpeg;base64,{{ $page->picture }}"/>
                    </div>
                    @endif

                    @if ($page->sound != null)
                    <div class="col-md-12 text-center">
                        <audio style="width: 100%;" controls preload="auto">
                            <source src="data:audio/mp3;base64, {{ $page->sound }}">
                        </audio>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection