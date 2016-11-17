@extends('layouts.owl.app')

@section('title', 'Account Management')
@section('header', 'Account Management')

@section('content')

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
			<a href="" class="btn btn-primary btn-sm">Change Password</a>
			<a href="" class="btn btn-primary btn-sm">Change Email</a>
			<a href="" class="btn btn-primary btn-sm">exemplo3</a>
		</div>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">Characters</div>
	<div class="panel-body padding-0">
		<table class="table table-hover table-bordered table-striped margin-bottom-5"">
			<tr>
				<th>	</th>
				<th>Name</th>
				<th>Vocation</th>
				<th>	</th>
			</tr>
			@foreach ($players as $player)
			<tr>
				<td class="col-md-1">1.</td>
				<td>{{ $player->name }}</td>
				<td>{{ $player->vocation }}</td>
				<td class="col-md-3">
					<div class="text-center">
						<a href="" class="btn btn-primary btn-xs">Edit</a>
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