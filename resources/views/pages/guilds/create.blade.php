@extends('layouts.owl.app')

@section('title','Create Guild')
@section('header','Create Guild')

@section('content')

    {!! Form::open(['route' => 'guild.store', 'class'=>'form-horizontal', 'id' => 'createguild']) !!}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', 'Guild Name', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('name', null, ['class' => 'form-control', 'minlength' => 4, 'maxlength' => 20, 'required', 'autofocus']) !!}
            @if ($errors->has('name'))
                <span class="help-block">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('ownerid') ? ' has-error' : '' }}">
        {!! Form::label('ownerid', 'Leader', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('ownerid', $players, null, ['placeholder' => 'Choose a player', 'class' => 'form-control']) !!}
            @if ($errors->has('ownerid'))
                <span class="help-block">
				<strong>{{ $errors->first('ownerid') }}</strong>
			</span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('motd') ? ' has-error' : '' }}">
        {!! Form::label('motd', 'Motd', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {{ Form::textarea('motd', NULL, ['class' => 'form-control', 'placeholder' => 'motd', 'id' => 'motd']) }}
            @if ($errors->has('motd'))
                <span class="help-block">
				<strong>{{ $errors->first('motd') }}</strong>
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

@section('js')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\CreateGuild', '#createguild') !!}
@endsection
