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
        {{ Form::textarea('content', NULL, ['class' => 'form-control', 'placeholder' => 'Content', 'id' => 'content', 'required']) }}
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
			{!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
		</div>
	</div>

	{!! Form::close() !!}
	<!-- /.row -->

@endsection

@section('css')
	<link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.css" rel="stylesheet">
@endsection

@section('js')
	<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.js"></script>
	<script>
		jQuery(document).ready(function() {
			jQuery('#content').summernote({
				height: 250,
			});
		});
    </script>
@endsection