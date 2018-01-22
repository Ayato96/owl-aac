@extends('layouts.owl.app')

@section('title', @trans('words.search_character'))
@section('header', @trans('words.search_character'))

@section('content')
<div class="col-md-12">
	<div class="panel panel-primary">
		<div class="panel-heading">@lang('words.search_character')</div>
		<div class="panel-body">
			{!! Form::open(['route' => 'player.search']) !!}
				<div class="form-group">
					{!! Form::label('name', @trans('words.name'), ['class' => 'col-md-2 control-label']) !!}
					<div class="col-md-8">
						{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
					</div>
					{!! Form::submit(@trans('words.search'), ['class' => 'btn btn-primary']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection