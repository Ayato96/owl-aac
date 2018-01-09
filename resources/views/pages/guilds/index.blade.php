@extends('layouts.owl.app')

@section('title', 'Guilds List')
@section('header', 'Guilds List')

@section('content')
    @foreach ($guilds as $guild)
        <div class="col-md-12">
            <img src="http://fakeimg.pl/128x128/" alt="..." class="img-rounded" align="left">
            <div class="col-md-8">
                <div>Name: {{ $guild->name }}</div>
                <div>Motd: {{ $guild->motd }}</div>
                <div>Owner: 
                    {!! link_to_route('player.show', $guild->owner->name, [$guild->owner->name], []) !!}
                </div>
                <div>Members: {{ $guild->players->count() }}</div>
                <div>Creation date: {{ $guild->creationdata }}</div>
                <div>
                    {!! link_to_route('guild.show', "More info", [$guild->id], []) !!}
                </div>
                <hr>
            </div>
        </div>
    @endforeach
@endsection