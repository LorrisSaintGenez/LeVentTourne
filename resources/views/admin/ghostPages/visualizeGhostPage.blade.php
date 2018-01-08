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
                        <h4 style="white-space: pre-wrap;">{{ $page->description }}</h4>
                    </div>

                    @if ($page->video != null)
                    <div class="col-md-12 text-center">
                        <iframe src="http://www.youtube.com/embed/{{$page->video}}" width="100%" height="350" frameborder="0" allowfullscreen></iframe>
                    </div>
                    @endif

                    @if ($page->picture != null)
                    <div class="col-md-12 text-center">
                        <img src="data:image/jpeg;base64,{{ $page->picture }}"/>
                    </div>
                    @endif

                    @if ($page->sound != null)
                    <div class="col-md-12 text-center">
                        <audio controls preload="metadata">
                            <source src="data:audio/mp3;base64, {{ $page->sound }}">
                        </audio>
                    </div>
                    @endif

                    <div class="form-group">
                        <div class="col-md-2">
                            <a href="{{ route('ghostPageEdition', $page->id) }}" type="submit" class="btn btn-lg btn-info">
                                Editer
                            </a>
                        </div>
                        <div class="col-md-2">
                            <form method="POST" action="{{ route('ghostPageDelete', $page->id) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" class="btn btn-lg btn-danger">
                                    Supprimer
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