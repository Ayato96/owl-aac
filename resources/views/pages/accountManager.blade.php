@extends('layouts.owl.app')

@section('title', 'Account Management')
@section('header', 'Account Management')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="panel panel-primary">
	<div class="panel-heading">Account Status</div>
	<div class="panel-body padding-0">
		<table class="table table-hover table-bordered table-striped margin-bottom-5">
			<tr>
				<td class="col-md-3">Account Name:</td>
				<td>{{ Auth::user()->name }}</td>
			</tr>
			<tr>
				<td class="col-md-3">Email:</td>
				<td>{{ Auth::user()->email }}</td>
			</tr>
			<tr>
				<td class="col-md-3">Account Status:</td>
				<td>
					@if (Auth::user()->premdays>0)
					Premium Account
					@else
					Free Account
					@endif
				</td>
			</tr>
		</table>
		<div class="text-center margin-bottom-5">
			<a href="account/change/password" class="btn btn-primary btn-sm">Change Password</a>
			<a href="account/change/email" class="btn btn-primary btn-sm">Change Email</a>
		</div>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">Characters</div>
	<div class="panel-body padding-0">
		<table class="table table-hover table-bordered table-striped margin-bottom-5"">
		@if ($players->isEmpty())
			<div class="text-center">
				You don't have characters.
			</div>
		@else
			<tr>
				<th>	</th>
				<th>Name</th>
				<th>Vocation</th>
				<th>Level</th>
				<th>	</th>
			</tr>
		@endif
			@foreach ($players as $player)
			<tr>
				<td class="col-md-1">{{ $loop->iteration }}.</td>
				<td>{{ $player->name }}</td>
				<td>{{ $player->vocation }}</td>
				<td>{{ $player->level }}</td>
				<td class="col-md-3">
					<div class="text-center">
						{!! link_to_route('player.edit', 'Edit',
							[$player->id], ['class' => 'btn btn-primary btn-xs']) !!}
						<a href="" class="btn btn-danger btn-xs">Delete</a>
					</div>
				</td>
			</tr>
			@endforeach
		</table>
		<div class="pull-right margin-bottom-5 margin-right-5">
			<a href="{{ route('player.create') }}" class="btn btn-primary btn-sm">Create</a>
		</div>
	</div>
</div>

@endsection