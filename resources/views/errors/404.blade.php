@extends('layouts.owl.errors')

@section('title', 'Not found.')

@section('content')
<p>Not found.</p>
<a class="btn btn-primary btn-lg" href="{{ route('home') }}"><b>Home Page</b></a>
@endsection