@extends('layouts.owl.app')

@section('title', @trans('words.news'))
@section('header', @trans('words.news'))

@section('content')

    <div class="col-md-12">
        @foreach ($posts as $post)
            <h1>{{ $post->title }}</h1>
            {!! $post->content !!}
            <div>
                <span class="badge">Posted {{ $post->created_at }} by {{ $post->player->name }}</span>
                {{-- <div class="pull-right">
                    <span class="label label-default">alice</span>
                    <span class="label label-primary">New</span>
                    <span class="label label-success">Update</span>
                    <span class="label label-info">Information</span>
                    <span class="label label-warning">Warning</span>
                    <span class="label label-danger">Danger</span>
                </div>  --}}
            </div>
            <hr>
        @endforeach
    </div>
@endsection