@extends('layouts.master')

@section('title', 'Recovery Account')
@section('header', 'Recovery Account')

@section('content')
    {{Form::open(['route' => 'key.recovery.password', 'class' => 'form-horizontal', 'id' => 'resetPassword'])}}
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        {!! Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::password('password', ['class' => 'form-control', 'minlength' => 7, 'required']) !!}
            @if ($errors->has('password'))
                <span class="help-block">
			<strong>{{ $errors->first('password') }}</strong>
		</span>
            @endif
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password_confirm', 'Confirm password', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'minlength' => 7,'required']) !!}
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
			<strong>{{ $errors->first('password_confirmation') }}</strong>
		</span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            {!! Form::submit('Change', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\RecoveryPassword', '#resetPassword') !!}
@endsection