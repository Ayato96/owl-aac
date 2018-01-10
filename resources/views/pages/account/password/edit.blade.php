@extends('layouts.owl.app')

@section('title', 'Change Password')
@section('header', 'Change Password')

@section('content')

{!! Form::open(['route' => 'account.update.password', 'class'=>'form-horizontal']) !!}

<div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
    {!! Form::label('current_password', 'Current password', ['class' => 'col-md-4 control-label']) !!}
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
    {!! Form::label('new_password', 'New password', ['class' => 'col-md-4 control-label']) !!}
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
    {!! Form::label('new_password_confirmation', 'Confirm new password', ['class' => 'col-md-4 control-label']) !!}
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
        {!! Form::submit('Change', ['class'=>'btn btn-primary']) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection

@section('js')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\ChangePassword') !!}
@endsection