@extends('layouts.owl.app')

@section('title', 'Recovery Key')
@section('header', 'Recovery Key')

@section('content')
	<h1 class="text-center">{{ $key }}</h1>
	<hr>
	<p>
		With this key you can recover your account if you lose access to your email.
		This key will not be generated nor shown again, store it in a safe place.
	</p>
	<div class="text-center">
		{!! link_to_route('account.index', 'Back to Account', [], ['class' => 'btn btn-primary']) !!}
	</div>
@endsection