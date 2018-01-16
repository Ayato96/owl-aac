<div class="panel-group">

	<div class="panel panel-primary">
		<div class="panel-heading">Rank Level</div>
		<div class="panel-body">
			@if ($playerRank->isEmpty())
				No players
			@endif
			@foreach ($playerRank as $playerRank)
			<div class="rank-players">
			{{ $loop->iteration }}- <a href="/player/{{ $playerRank->name }}">{!! $playerRank->name !!}</a>
				<span class="badge">{!! $playerRank->level !!}</span>
			</div>
			@endforeach
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">Another Rank</div>
		<div class="panel-body">Code here</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">Rank Frags</div>
		<div class="panel-body">Code here</div>
	</div>

</div>