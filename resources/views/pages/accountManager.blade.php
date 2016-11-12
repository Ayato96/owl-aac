@extends('layouts.owl.app')

@section('title', 'Account Management')
@section('header', 'Account Management')

@section('content')
{{-- {!! Auth::user()->players()->first()->toSql() !!} --}}
<div class="panel panel-primary">
	<div class="panel-heading">Account Status</div>
	<div class="panel-body" style="padding: 0px;">
		<table class="table table-hover table-bordered table-striped" style="margin-bottom: 5px;">
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
		<div class="text-center" style="margin-bottom: 5px;">
			<a href="" class="btn btn-primary btn-sm">Change Password</a>
			<a href="" class="btn btn-primary btn-sm">Change Email</a>
			<a href="" class="btn btn-primary btn-sm">exemplo3</a>
		</div>
	</div>
</div>

	

<div class="panel panel-primary">
	<div class="panel-heading">Characters</div>
	<div class="panel-body" style="padding: 0px;">
		<table class="table table-hover table-bordered table-striped" style="margin-bottom: 5px;">
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
		<div class="pull-right" style="margin-bottom: 5px; margin-right: 5px;">
			<a href="{{ route('player.create') }}" class="btn btn-primary btn-sm">Create</a>
		</div>
	</div>
</div>

@endsection