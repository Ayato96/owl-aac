@extends('layouts.owl.app')

@section('title', @trans('words.edit_player'))
@section('header', @trans('words.edit_player'))

@section('content')
<div class="col-md-12">

	<h2 class="text-center">@lang('words.editing_player'): {!! $player->name !!}</h2>
	{!! Form::model($player, ['route' => ['player.update', $player->id]]) !!}
	
	<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
		{!! Form::label('description', @trans('words.description'), ['class' => 'col-md-4 control-label']) !!}
		{!! Form::textarea('description', null, ['class' => 'form-control noresize', 'maxlength' => 200, 'rows' => "3", 'autofocus']) !!}
		@if ($errors->has('description'))
			<span class="help-block">
				<strong>{{ $errors->first('description') }}</strong>
			</span>
		@endif
	</div>
		<div class="col-md-12">
		{!! Form::submit(@trans('words.save'), ['class' => 'btn btn-primary center-block']) !!}
		</div>
	{!! Form::close() !!}

</div>
@endsection


