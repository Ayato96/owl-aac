@extends('layouts.owl.app')

@section('title','Create Character')
@section('header','Create Character')

@section('content')

{!! Form::open(['route' => 'player.store', 'class'=>'form-horizontal', 'id' => 'teste']) !!}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	{!! Form::label('name', 'Character Name', ['class' => 'col-md-4 control-label']) !!}
	<div class="col-md-6">
		{!! Form::text('name', null, ['class' => 'form-control', 'minlength' => 7, 'maxlength' => 32, 'required', 'autofocus']) !!}
		@if ($errors->has('name'))
		<span class="help-block">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('sex') ? ' has-error' : '' }}">
	{!! Form::label('sex', 'Sex', ['class' => 'col-md-4 control-label']) !!}
	<div class="col-md-6">
		<div class="btn-group center-block" data-toggle="buttons">
			<label class="btn btn-primary active">
				<input type="radio" name="sex" id="sex" autocomplete="off" value="0" checked> Female
			</label>
			<label class="btn btn-primary">
				<input type="radio" name="sex" id="sex" autocomplete="off" value="1"> Male
			</label>
		</div>
		@if ($errors->has('sex'))
		<span class="help-block">
			<strong>{{ $errors->first('sex') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('vocation') ? ' has-error' : '' }}">
	{!! Form::label('vocation', 'Vocation', ['class' => 'col-md-4 control-label']) !!}
	<div class="col-md-6">
		<div class="btn-group center-block" data-toggle="buttons">
			<label class="btn btn-primary active">
				<input type="radio" name="vocation" id="vocation" autocomplete="off" value="5" checked> Sorcerer
			</label>
			<label class="btn btn-primary">
				<input type="radio" name="vocation" id="vocation" autocomplete="off" value="6"> Druid
			</label>
			<label class="btn btn-primary">
				<input type="radio" name="vocation" id="vocation" autocomplete="off" value="7"> Paladin
			</label>
			<label class="btn btn-primary">
				<input type="radio" name="vocation" id="vocation" autocomplete="off" value="8"> Knight
			</label>
		</div>
		@if ($errors->has('vocation'))
		<span class="help-block">
			<strong>{{ $errors->first('vocation') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('town_id') ? ' has-error' : '' }}">
	{!! Form::label('town_id', 'Town', ['class' => 'col-md-4 control-label']) !!}
	<div class="col-md-6">
		<div class="btn-group center-block" data-toggle="buttons">
			<label class="btn btn-primary active">
				<input type="radio" name="town_id" id="town_id" autocomplete="off" value="1" checked> Thais
			</label>
			<label class="btn btn-primary">
				<input type="radio" name="town_id" id="town_id" autocomplete="off" value="2"> Carlin
			</label>
			<label class="btn btn-primary">
				<input type="radio" name="town_id" id="town_id" autocomplete="off" value="3"> Venore
			</label>
		</div>
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
