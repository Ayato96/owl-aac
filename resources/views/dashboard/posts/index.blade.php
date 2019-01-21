@extends('layouts.dashboard')

@section('title', 'News')
@section('header', 'News')

@section('content')

<div class="panel panel-default">
	<div class="panel-body">
		<table width="100%" class="table table-striped table-bordered table-hover" id="newsDataTable">
			<thead>
				<tr>
					<th>Id</th>
					<th>Title</th>
					<th>Player</th>
					<th>Created At</th>
					<th>Updated At</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($posts as $post)
				<tr>
					<td>{{ $post->id }}</td>
					<td>{{ $post->title }}</td>
					<td>{{ $post->player->name }}</td>
					<td>{{ $post->created_at }}</td>
					<td>{{ $post->updated_at }}</td>
					<td>Buttons</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{-- /.table-responsive --}}
	</div>
	{{-- /.panel-body --}}
</div>
{{-- /.panel --}}
@endsection

@section('css')
	<link href="{{ themes('css/dataTables.bootstrap.css')}}" rel="stylesheet">
	<link href="{{ themes('css/dataTables.responsive.css')}}" rel="stylesheet">
@endsection

@section('js')
<script src="{{ themes('js/jquery.dataTables.js') }}"></script>
<script src="{{ themes('js/dataTables.bootstrap.js') }}"></script>
<script src="{{ themes('js/dataTables.responsive.js') }}"></script>
	<script>
		$(document).ready(function(){
            $('#newsDataTable').DataTable();
        });
	</script>
@endsection