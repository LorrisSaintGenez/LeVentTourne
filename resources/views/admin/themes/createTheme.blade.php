@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('noTheme'))
            <div class="alert alert-danger">
                {{ session('noTheme') }}
            </div>
            @endif
            @if (session('successTheme'))
            <div class="alert alert-success">
                {{ session('successTheme') }}
            </div>
            @endif

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Création d'un thème</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('themeCreate') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-4 control-label">Titre <span style="color: red">*</span></label>

                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                        @if ($errors->has('title'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                                    <label for="picture" class="col-md-4 control-label">Image</label>

                                    <div class="col-md-6">
                                        <input type="file" id="picture" class="form-control" name="picture" value="{{ old('picture') }}" autofocus>

                                        @if ($errors->has('picture'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('picture') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Créer le thème
                                        </button>
                                    </div>
                                </div>

                            <div>
                                <span><span style="color: red">*</span> Les champs avec une étoile sont obligatoires.</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
            @if ($themes->count() > 0)
                @foreach ($themes as $theme)
                    <div class="col-md-4 col-sm-6">
                        <div class="admin_theme">
                            @if ($theme->picture)
                            <img data-toggle="modal" data-target="#<?php echo str_replace(" ", "_", $theme->title); ?>-image" src="/images/remove-picture.svg" width="25" class="svg-icon svg-remove-image" alt="Enlever l'image"/>
                            @endif
                            <img data-toggle="modal" data-target="#<?php echo str_replace(" ", "_", $theme->title); ?>-edit" src="/images/edit.svg" width="25" class="svg-icon svg-edit" alt="Editer le thème"/>
                            <img data-toggle="modal" data-target="#<?php echo str_replace(" ", "_", $theme->title); ?>-delete" src="/images/delete-button.svg" width="25" class="svg-icon svg-delete" alt="Supprimer le thème" />
                            <h2>
                                {{ $theme->title }}
                            </h2>
                            @if ($theme->picture)
                            <img src="data:image/jpeg;base64,{{ $theme->picture }}" class="image_theme">
                            @endif
                        </div>
                    </div>
                    <div id="<?php echo str_replace(" ", "_", $theme->title); ?>-image" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Suppression de l'image du thème {{ $theme->title }}</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Êtes-vous certain de vouloir supprimer cette image ? L'action est irréversible.</p>
                                </div>
                                <form id="<?php echo str_replace(" ", "_", $theme->title); ?>-image" class="form-horizontal" method="POST" action="{{ route('themeRemoveImage', $theme->id) }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <div class="modal-footer">
                                        <button type="submit" class="confirm-delete-button btn btn-default" data-dismiss="modal" onclick="form_submit('<?php echo str_replace(" ", "_", $theme->title); ?>-image')">Oui</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div id="<?php echo str_replace(" ", "_", $theme->title); ?>-edit" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <form class="form-horizontal" id="<?php echo str_replace(" ", "_", $theme->title); ?>-edit" method="POST" action="{{ route('themeEdit') }}" enctype="multipart/form-data">
                                    <input id="id" name="id" value="{{ $theme->id }}" hidden>
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Modification du thème {{ $theme->title }}</h4>
                                    </div>
                                    <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="form-group{{ $errors->has('title-edit') ? ' has-error' : '' }}">
                                                <label for="title-edit" class="col-md-4 control-label">Titre <span style="color: red">*</span></label>

                                                <div class="col-md-6">
                                                    <input id="title-edit" type="text" class="form-control" name="title-edit" value="{{ $theme->title }}" required autofocus>

                                                    @if ($errors->has('title-edit'))
                                                    <span class="help-block">
                                                        <strong>Le champ Titre est nécessaire.</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                                                <label for="picture" class="col-md-4 control-label">Image</label>

                                                <div class="col-md-6">
                                                    <input type="file" id="picture" class="form-control" name="picture" autofocus>

                                                    @if ($theme->picture)
                                                    <br>
                                                    <img src="data:image/jpeg;base64,{{ $theme->picture }}" class="image_theme">
                                                    @endif

                                                    @if ($errors->has('picture'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('picture') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default" data-dismiss="modal" onclick="form_submit('<?php echo str_replace(" ", "_", $theme->title); ?>-edit')">Appliquer</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div id="<?php echo str_replace(" ", "_", $theme->title); ?>-delete" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Suppression du thème {{ $theme->title }}</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Êtes-vous certain de vouloir supprimer ce thème ? L'action est irréversible.</p>
                                    <p>Tous les quiz liés à ce thème seront supprimés.</p>
                                </div>
                                <form id="<?php echo str_replace(" ", "_", $theme->title); ?>-delete" class="form-horizontal" method="POST" action="{{ route('themeDelete', $theme->id) }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <div class="modal-footer">
                                        <button type="submit" class="confirm-delete-button btn btn-default" data-dismiss="modal" onclick="form_submit('<?php echo str_replace(" ", "_", $theme->title); ?>-delete')">Oui</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
            <h2 class="text-center text-danger">Aucun thème disponible</h2>
            @endif
            </div>
        </div>
    </div>
</div>
<script>
  function form_submit(form_id) {
    document.forms[form_id].submit();
  }
</script>
@endsection