@extends('layouts.dashboard')

@section('title', 'Create News')
@section('header', 'Create News')

@section('content')

{{-- PANELS --}}
<div class="row">
	{!! Form::open(['route' => 'post.store', 'class'=>'form-horizontal']) !!}

	<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	{!! Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) !!}
		<div class="col-md-6">
		{!! Form::text('title', null, ['class' => 'form-control', 'maxlength' => 40, 'required', 'autofocus']) !!}
		@if ($errors->has('title'))
			<span class="help-block">
			<strong>{{ $errors->first('title') }}</strong>
			</span>
			@endif
		</div>
	</div>

	<div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
		{!! Form::label('content', 'Content', ['class' => 'col-md-4 control-label']) !!}
		<div class="col-md-6">
        {{ Form::textarea('content', NULL, ['class' => 'form-control my-editor', 'placeholder' => 'Content', 'id' => 'content']) }}
			@if ($errors->has('content'))
			<span class="help-block">
				<strong>{{ $errors->first('content') }}</strong>
			</span>
			@endif
		</div>
	</div>

	<div class="form-group {{ $errors->has('player_id') ? ' has-error' : '' }}">
		{!! Form::label('player_id', 'Player Name', ['class' => 'col-md-4 control-label']) !!}
		<div class="col-md-6">
			{!! Form::select('player_id', $players, null, ['placeholder' => 'Choose a player', 'class' => 'form-control']) !!}
			@if ($errors->has('player_id'))
			<span class="help-block">
				<strong>{{ $errors->first('player_id') }}</strong>
			</span>
			@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
			{!! Form::submit('Post', ['class'=>'btn btn-primary']) !!}
		</div>
	</div>

	{!! Form::close() !!}
	<!-- /.row -->

@endsection

@section('css')
	
@endsection

@section('js')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>
		var editor_config = {
			path_absolute : "/",
			selector: "textarea.my-editor",
			plugins: [
			"advlist autolink lists link image charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars code fullscreen",
			"insertdatetime media nonbreaking save table contextmenu directionality",
			"emoticons template paste textcolor colorpicker textpattern"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
			relative_urls: false,
			file_browser_callback : function(field_name, url, type, win) {
			var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
			var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

			var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
			if (type == 'image') {
				cmsURL = cmsURL + "&type=Images";
			} else {
				cmsURL = cmsURL + "&type=Files";
			}

			tinyMCE.activeEditor.windowManager.open({
				file : cmsURL,
				title : 'Filemanager',
				width : x * 0.8,
				height : y * 0.8,
				resizable : "yes",
				close_previous : "no"
			});
			}
		};

		tinymce.init(editor_config);
	</script>
@endsection