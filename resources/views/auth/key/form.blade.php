@extends('layouts.owl.app')

@section('title', 'Recovery Account')
@section('header', 'Recovery Account')

@section('content')
	{!! Form::open(['route' => 'key.recovery', 'class'=>'form-horizontal']) !!}

	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', 'Account Name', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('name', null, ['class' => 'form-control', 'minlength' => 7, 'maxlength' => 32, 'required', 'autofocus']) !!}
            @if ($errors->has('name'))
                <span class="help-block">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
        {!! Form::label('key', 'Recovery Key', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('key', null, ['class' => 'form-control', 'maxlength' => 20, 'required']) !!}
            @if ($errors->has('key'))
                <span class="help-block">
			<strong>{{ $errors->first('key') }}</strong>
		</span>
            @endif
        </div>
    </div>

	<div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            {!! Form::submit('Recovery', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>

	{!! Form::close() !!}
@endsection