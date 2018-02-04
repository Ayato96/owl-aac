@extends('layouts.master')

@section('title', @trans('words.guild_list'))
@section('header', @trans('words.guild_list'))

@section('content')
    @foreach ($guilds as $guild)
        <div class="col-md-12">
            <img src="http://fakeimg.pl/128x128/" alt="..." class="img-rounded" align="left">
            <div class="col-md-8">
                <div>@lang('words.name'): {{ $guild->name }}</div>
                <div>Motd: {{ $guild->motd }}</div>
                <div>@lang('words.owner'):
                    {!! link_to_route('player.show', $guild->owner->name, [$guild->owner->name], []) !!}
                </div>
                <div>@lang('words.members'): {{ $guild->players->count() }}</div>
                <div>@lang('words.created'): {{ $guild->creationdata }}</div>
                <div>
                    {!! link_to_route('guild.show', "More info", [$guild->id], []) !!}
                </div>
                <hr>
            </div>
        </div>
    @endforeach
@endsection