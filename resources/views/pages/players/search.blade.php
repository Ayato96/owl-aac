@extends('layouts.owl.app')

@section('title', 'Player')
@section('header', 'Player')

@section('content')
<div class="col-md-12">
	<div class="panel panel-primary">
		<div class="panel-heading">Search Character</div>
		<div class="panel-body">
			{!! Form::open(['route' => 'player.search']) !!}
				<div class="form-group">
					{!! Form::label('name', 'Name:', ['class' => 'col-md-2 control-label']) !!}
					<div class="col-md-8">
						{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
					</div>
					{!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection