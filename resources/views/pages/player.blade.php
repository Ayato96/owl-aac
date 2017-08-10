@extends('layouts.owl.app')

@section('title', 'Player')
@section('header', 'Player')

@section('content')
<div class="col-md-12">
	
	<div class="panel panel-primary">
		<div class="panel-heading">Player Information</div>
		<div class="panel-body padding-0">
			<table class="table table-hover table-bordered table-striped margin-bottom-5">
				
				<tr>
					<td class="col-md-3">Name:</td>
					<td>{{ $player['name'] }}</td>
				</tr>
				<tr>
					<td class="col-md-3">Sex:</td>
					<td>{{ $player['sex'] }}</td>
				</tr>
				<tr>
					<td class="col-md-3">Vocation:</td>
					<td>{!! $player['vocation'] !!}</td>
				</tr>
				<tr>
					<td class="col-md-3">Level:</td>
					<td>{{ $player['level'] }}</td>
				</tr>
				<tr>
					<td class="col-md-3">World:</td>
					<td>{{ $player['world_id'] }}</td>
				</tr>
				<tr>
					<td class="col-md-3">Residence:</td>
					<td>{{ $player['town_id'] }}</td>
				</tr>
				<tr>
					<td class="col-md-3">Marital status:</td>
					<td>{{ $player['marriage'] }}</td>
				</tr>
				<tr>
					<td class="col-md-3">Last login:</td>
					<td>{{ $player['lastlogin'] }}</td>
				</tr>
				<tr>
					<td class="col-md-3">Description:</td>
					<td>{{ $player['description'] }}</td>
				</tr>
				<tr>
					<td class="col-md-3">Account status:</td>
					<td>
					@if ($playerAccount['premdays']==0)
						Free Account
						@else
						Premium Account
						@endif	
					</td>
				</tr>
				
			</table>
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">Deaths</div>
		<div class="panel-body padding-0">
			<table class="table table-hover table-bordered table-striped margin-bottom-5">
				@foreach ($player->deaths as $death)
				<tr>
					<td class="col-md-4">{{ $death->time }}</td>
					<td>
						Killed at level {{ $death->level }} by {!! $death->killed_by !!} 
						@if ($death->killed_by != $death->mostdamage_by)
							and {!! $death->mostdamage_by !!}
						@endif
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">Frags</div>
		<div class="panel-body padding-0">
			<table class="table table-hover table-bordered table-striped margin-bottom-5">
				
				...
				
			</table>
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">Account Information</div>
		<div class="panel-body padding-0">
			<table class="table table-hover table-bordered table-striped margin-bottom-5">
				
				<tr>
					<td class="col-md-3">Created:</td>
					<td>{{ $player->account->created_at }}</td>
				</tr>
				<tr>
					<td class="col-md-3">Vip status:</td>
					<td>---</td>
				</tr>

			</table>
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">Characters</div>
		<div class="panel-body padding-0">
			<table class="table table-hover table-bordered table-striped margin-bottom-5">
				<tr>
					<th>	</th>
					<th>Name</th>
					<th>World</th>
					<th>Status</th>
					<th>	</th>
				</tr>
				{{-- @foreach (App\Account::find($playerAccount['id'])->players as $players) --}}
				@foreach ($player->account->players as $player)
				<tr>
					<td class="col-md-1">{{ $loop->iteration }}.</td>
					<td>{{ $player->name }}</td>
					<td>{{ $player->world_id }}</td>
					<td>{{ $player->online }}</td>
					<td>
						<div class="text-center">
							{!!
								link_to_route('player.show', 'Show',
									[$player->slug], ['class' => 'btn btn-primary btn-xs'])
							!!}
						</div>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>

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