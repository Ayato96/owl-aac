@extends('layouts.master')

@section('title', @trans('words.create_account'))
@section('header', @trans('words.create_account'))

@section('content')

    {!! Form::open(['route' => 'account.store', 'class'=>'form-horizontal']) !!}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', @trans('words.account_name'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('name', null, ['class' => 'form-control', 'minlength' => 7, 'maxlength' => 32, 'required', 'autofocus']) !!}
            @if ($errors->has('name'))
                <span class="help-block">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
        {!! Form::label('email', @trans('words.email_address'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
            @if ($errors->has('email'))
                <span class="help-block">
			<strong>{{ $errors->first('email') }}</strong>
		</span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        {!! Form::label('password', @trans('words.password'), ['class' => 'col-md-4 control-label']) !!}
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
        {!! Form::label('password_confirm', @trans('words.confirm_password'), ['class' => 'col-md-4 control-label']) !!}
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
            {!! Form::submit(@trans('words.create'), ['class'=>'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\CreateAccount') !!}
@endsection