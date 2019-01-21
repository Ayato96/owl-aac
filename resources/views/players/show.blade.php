@extends('layouts.master')

@section('title', @trans('words.player_information').' - '.$player['name'])
@section('header', @trans('words.player_information').' - '.$player['name'])

@section('content')
<div class="col-md-12">
	<div class="panel panel-primary">
		<div class="panel-heading">@lang('words.player_information')</div>
		<div class="panel-body padding-0">
			<table class="table table-hover table-bordered table-striped margin-bottom-5">
				<tr>
					<td class="col-md-3">@lang('words.name'):</td>
					<td>{{ $player->name }}</td>
				</tr>
				<tr>
					<td class="col-md-3">Sex:</td>
					<td>{{ $player->sex }}</td>
				</tr>
				<tr>
					<td class="col-md-3">@lang('words.vocation'):</td>
					<td>{{ $player->vocation }}</td>
				</tr>
				<tr>
					<td class="col-md-3">@lang('words.level'):</td>
					<td>{{ $player->level }}</td>
				</tr>
				@if ($player->getGuild())
					<tr>
						<td class="col-md-3">@lang('words.guild'):</td>
						<td>{{ $player->getGuild() }}</td>
					</tr>
				@endif
				<tr>
					<td class="col-md-3">@lang('words.residence'):</td>
					<td>{{ $player->getTown() }}</td>
				</tr>
				<tr>
					<td class="col-md-3">@lang('words.marital_status'):</td>
					<td>{{ $player->marriage }}</td>
				</tr>
				<tr>
					<td class="col-md-3">@lang('words.last_login'):</td>
					<td>{{ $player->lastlogin }}</td>
				</tr>
				@if ($player->description)
					<tr>
						<td class="col-md-3">@lang('words.description'):</td>
						<td>{{ $player->description }}</td>
					</tr>
				@endif
				<tr>
					<td class="col-md-3">@lang('words.account_status'):</td>
					<td>{{ $player->getPremiumStatus() }}</td>
				</tr>
			</table>
		</div>
	</div>
	@if (!$player->deaths->isEmpty())
		<div class="panel panel-primary">
			<div class="panel-heading">@lang('words.deaths')</div>
			<div class="panel-body padding-0">
				<table class="table table-hover table-bordered table-striped margin-bottom-5">
					@foreach ($player->deaths as $death)
					<tr>
						<td class="col-md-4">{{ $death->time }}</td>
						<td>
							@lang('words.killed_at_level') {{ $death->level }} @lang('words.by') {!! $death->killed_by !!}
							@if ($death->killed_by != $death->mostdamage_by)
								@lang('words.and') {!! $death->mostdamage_by !!}
							@endif
						</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	@endif

	{{-- <div class="panel panel-primary">
		<div class="panel-heading">Frags</div>
		<div class="panel-body padding-0">
			<table class="table table-hover table-bordered table-striped margin-bottom-5">
				...
			</table>
		</div>
	</div> --}}

	<div class="panel panel-primary">
		<div class="panel-heading">@lang('words.account_info')</div>
		<div class="panel-body padding-0">
			<table class="table table-hover table-bordered table-striped margin-bottom-5">
				<tr>
					<td class="col-md-3">@lang('words.created'):</td>
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
		<div class="panel-heading">@lang('words.characters')</div>
		<div class="panel-body padding-0">
			<table class="table table-hover table-bordered table-striped margin-bottom-5">
				<tr>
					<th>	</th>
					<th>@lang('words.name')</th>
					<th>@lang('words.status')</th>
					<th>	</th>
				</tr>
				{{-- @foreach (App\Account::find($playerAccount['id'])->players as $players) --}}
				@foreach ($player->getPlayerList() as $player)
				<tr>
					<td class="col-md-1">{{ $loop->iteration }}.</td>
					<td>{{ $player->name }}</td>
					<td>{{ $player->online }}</td>
					<td>
						<div class="text-center">
							{!!
								link_to_route('player.show', @trans('words.show'),
									[$player->name], ['class' => 'btn btn-primary btn-xs'])
							!!}
						</div>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>

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