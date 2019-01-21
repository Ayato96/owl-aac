@extends('layouts.dashboard')

@section('title', 'Create News')
@section('header', 'Create News')

@section('content')

<div class="row">
	{!! Form::model($post, ['route' => 'post.update', 'class'=>'form-horizontal']) !!}

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
			{!! Form::textarea('content', NULL, ['class' => 'form-control', 'placeholder' => 'Content', 'id' => 'content', 'required']) !!}
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
			@if ($errors->has('town_id'))
			<span class="help-block">
				<strong>{{ $errors->first('town_id') }}</strong>
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

@endsection