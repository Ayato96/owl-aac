<div class="panel-group">

    <div class="panel panel-primary">
        <div class="panel-heading">@lang('words.rank_level')</div>
        <div class="panel-body">
            @if ($playerRank->isEmpty())
                No players
            @endif
            @foreach ($playerRank as $player)
                <div class="rank-players">
                    {{ $loop->iteration }}- <a href="/player/{{ $player->name }}">{!! $player->name !!}</a>
                    <span class="badge">{!! $player->level !!}</span>
                </div>
            @endforeach
        </div>
    </div>
    {{--
    <div class="panel panel-primary">
    <div class="panel-heading">Another Rank</div>
    <div class="panel-body">Code here</div>
</div>

    <div class="panel panel-primary">
    <div class="panel-heading">Rank Frags</div>
    <div class="panel-body">Code here</div>
</div>

        --}}
</div>