@extends('layouts.owl.app')

@section('title', 'Guild Information')
@section('header', 'Guild Information')

@section('content')

<div class="col-md-12 margin-bottom-10">
    <img src="http://fakeimg.pl/128x128/" alt="..." class="img-rounded" align="left">
    <div class="col-md-8">
        <div>Name: {{ $guild->name }}</div>
        <div>Motd: {{ $guild->motd }}</div>
        <div>Owner: {{ $guild->owner->name }}</div>
        <div>Members: {{ $guild->players->count() }}</div>
        <div>Creation date: {{ $guild->creationdata }}</div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">Members</div>
        <div class="panel-body">
            <table class="table table-hover table-bordered table-striped margin-bottom-5"">
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
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
            <div class="panel-heading">Invites</div>
            <div class="panel-body">
                <table class="table table-hover table-bordered table-striped margin-bottom-5"">
                    <tr>
                        <th>Name</th>
                        <th>Vocation</th>
                        <th>level</th>
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