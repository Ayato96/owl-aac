@extends('layouts.owl.app')

@section('title','Login')
@section('header','Login')

@section('content')

{!! Form::open(['route' => 'account.auth', 'class'=>'form-horizontal', 'id' => 'teste']) !!}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Account Name:', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'minlength' => 7, 'maxlength' => 32, 'required', 'autofocus']) !!}
        @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
    {!! Form::label('password', 'Password:', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {{ Form::password('password', ['class' => 'form-control', 'minlength' => 7, 'required']) }}
        @if ($errors->has('message'))
        <span class="help-block">
            <strong>{{ $errors->first('message') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit('Login', ['class'=>'btn btn-primary']) !!}
    </div>
</div>

{!! Form::close() !!}


@endsection
