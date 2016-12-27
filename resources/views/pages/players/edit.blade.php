@extends('layouts.owl.app')

@section('title', 'Edit Player')
@section('header', 'Edit Player')

@section('content')
<div class="col-md-12">

	<h2 class="text-center">Editing player: {!! $player->name !!}</h2>
	{!! Form::model($player, ['route' => ['player.update', $player->id]]) !!}
	
	<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
		{!! Form::label('description', 'Description:', ['class' => 'col-md-4 control-label']) !!}
		{!! Form::textarea('description', null, ['class' => 'form-control noresize', 'maxlength' => 200, 'rows' => "3", 'autofocus']) !!}
		@if ($errors->has('description'))
			<span class="help-block">
				<strong>{{ $errors->first('description') }}</strong>
			</span>
		@endif
	</div>
		<div class="col-md-12">
		{!! Form::submit('Save', ['class' => 'btn btn-primary center-block']) !!}
		</div>
	{!! Form::close() !!}

</div>
@endsection


