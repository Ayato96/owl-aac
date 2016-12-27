@extends('layouts.owl.errors')

@section('title', 'Unauthorized action.')

@section('content')
<p>Unauthorized action.</p>
<a class="btn btn-primary btn-lg" href="{{ route('home') }}"><b>Home Page</b></a>
@endsection