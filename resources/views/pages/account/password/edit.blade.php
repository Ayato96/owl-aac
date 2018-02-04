@extends('layouts.master')

@section('title', @trans('words.change_password'))
@section('header', @trans('words.change_password'))

@section('content')

{!! Form::open(['route' => 'account.update.password', 'class'=>'form-horizontal', 'id' => 'editPassword']) !!}

<div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
    {!! Form::label('current_password', @trans('words.current_password'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password('current_password', ['class' => 'form-control', 'minlength' => 7, 'maxlength' => 32, 'required']) !!}
        @if ($errors->has('current_password'))
        <span class="help-block">
            <strong>{{ $errors->first('current_password') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
    {!! Form::label('new_password', @trans('words.new_password'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password('new_password', ['class' => 'form-control', 'minlength' => 7, 'maxlength' => 32, 'required']) !!}
        @if ($errors->has('new_password'))
        <span class="help-block">
            <strong>{{ $errors->first('new_password') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
    {!! Form::label('new_password_confirmation', @trans('words.confirm_new_password'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password('new_password_confirmation', ['class' => 'form-control', 'minlength' => 7,'required']) !!}
        @if ($errors->has('new_password_confirmation'))
        <span class="help-block">
            <strong>{{ $errors->first('new_password_confirmation') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit(@trans('words.change'), ['class'=>'btn btn-primary']) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection

@section('js')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\ChangePassword', '#editPassword') !!}
@endsection