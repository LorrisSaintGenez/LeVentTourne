@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('successPage'))
            <div class="alert alert-success">
                {{ session('successPage') }}
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Pages fantômes</div>

                <div class="panel-body">

                    @foreach ($pages as $page)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 text-center">
                                <h3>
                                    <b>{{ $page->title }}</b>
                                </h3>
                            </div>
                            <div class="col-md-3 text-center" style="margin-top: 10px">
                                <a href="{{ route('ghostPageEdition', $page->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Editer
                                </a>
                            </div>
                            <div class="col-md-3 text-center" style="margin-top: 10px">
                                <a href="{{ route('ghostPagevisualize', $page->id) }}" type="submit" class="btn btn-lg btn-info">
                                    Visualiser
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    @endforeach
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <form method="GET" action="{{ route('ghostPageCreation') }}">
                        <button type="submit" class="btn btn-primary">
                            Créer une page
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection