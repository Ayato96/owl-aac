@extends('layouts.dashboard')

@section('title', 'Change Configurations')
@section('header', 'Change Configurations')

@section('content')

{{-- PANELS --}}
<div class="row">
    {!! Form::open(['route' => 'config.set', 'class'=>'form-horizontal']) !!}

    <div class="form-group{{ $errors->has('path') ? ' has-error' : '' }}">
    {!! Form::label('path', 'Path', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
        {!! Form::text('path', $dir, ['class' => 'form-control', 'maxlength' => 40, 'required', 'autofocus']) !!}
        @if ($errors->has('path'))
            <span class="help-block">
            <strong>{{ $errors->first('path') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            {!! Form::submit('Edit', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}
    <!-- /.row -->


@endsection