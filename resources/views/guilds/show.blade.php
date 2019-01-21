@extends('layouts.master')

@section('title', @trans('words.guild_information'))
@section('header', @trans('words.guild_information'))

@section('content')

<div class="col-md-12 margin-bottom-10">
    <img src="http://fakeimg.pl/128x128/" alt="..." class="img-rounded" align="left">
    <div class="col-md-8">
        <div>@lang('words.name'): {{ $guild->name }}</div>
        <div>Motd: {{ $guild->motd }}</div>
        <div>@lang('words.owner'): {{ $guild->owner->name }}</div>
        <div>@lang('words.members'): {{ $guild->players->count() }}</div>
        <div>@lang('words.created'): {{ $guild->creationdata }}</div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">@lang('words.members')</div>
        <div class="panel-body">
            <table class="table table-hover table-bordered table-striped margin-bottom-5" id="membersList">
                <tr>
                    <th>Rank</th>
                    <th>@lang('words.name')</th>
                </tr>
                @foreach ($ranks as $rank)
                    <tr>
                        <td>{{ $rank[0]->name }}</td>
                        <td>
                            @foreach ($rank[0]->players as $player)
                                <div>
                                    {!! link_to_route('player.show', $player->name, [$player->name], []) !!}
                                    ({{ $player->membership->nick }})
                                </div>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@if (!$guild->invites->isEmpty())
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">@lang('words.invites')</div>
            <div class="panel-body">
                <table class="table table-hover table-bordered table-striped margin-bottom-5"">
                    <tr>
                        <th>@lang('words.name')</th>
                        <th>@lang('words.vocation')</th>
                        <th>@lang('words.level')</th>
                    </tr>
                    @foreach ($guild->invites as $player)
                        <tr>
                            <td>{!! link_to_route('player.show', $player->name, [$player->name], []) !!}</td>
                            <td>{{ $player->vocation }}</td>
                            <td>{{ $player->level }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endif

@endsection