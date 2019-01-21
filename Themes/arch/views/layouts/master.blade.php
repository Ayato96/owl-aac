<!DOCTYPE html>
<html>
<head>
	<title>{{ Setting::get('server.name') }} - @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ themes('css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ themes('css/bootstrap-theme.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ themes('css/arch.css') }}">
	@yield('css')
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			{{-- HEADER --}}
			<div class="col-md-10 col-md-offset-1 margin-bottom-10">
				@include('layouts.partials.header')
			</div> {{-- ENDHEADER --}}
			
			{{-- MENU --}}
			<div class="col-md-2 col-md-offset-1">
				@include('layouts.partials.left')
			</div> {{-- ENDMENU --}}
			
			{{-- CONTENT --}}
			<div class="content">
				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">@yield('header')</div>
						<div class="panel-body">
							@include('flash::message')
							@yield('content')
						</div>
					</div>
				</div>
			</div>{{-- ENDCONTENT --}}
			
			{{-- RIGHTSIDEBAR --}}
			<div class="col-md-2">
				@include('layouts.partials.right')
			</div>{{-- ENDRIGHTSIDEBAR --}}
		</div> {{-- ENDROW --}}
	</div>{{-- ENDCONTAINER --}}
	
	<script src="{{ themes('js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ themes('js/bootstrap.min.js') }}"></script>
	@yield('js')
	<script>
		$('#flash-overlay-modal').modal();
	</script>
</body>

</html>