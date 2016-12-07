<!DOCTYPE html>
<html>
<head>
	<title>{{ Setting::get('Server.Name') }} - @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/owl.css') }}">
</head>
<body>
	<div class="container-fluid">
		<div class="row">

			{{-- HEADER --}}
			<div class="col-md-10 col-md-offset-1 margin-bottom-10">
				@include('layouts.owl.header')
			</div> {{-- ENDHEADER --}}
			
			{{-- MENU --}}
			<div class="col-md-2 col-md-offset-1">
				@include('layouts.owl.menu.left')
			</div> {{-- ENDMENU --}}
			
			{{-- CONTENT --}}
			<div class="content">
				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">@yield('header')</div>
						<div class="panel-body">
							@yield('content')
						</div>
					</div>
				</div>
			</div>{{-- ENDCONTENT --}}

			{{-- RIGHTSIDEBAR --}}
			<div class="col-md-2">
				@include('layouts.owl.menu.right')
			</div>{{-- ENDRIGHTSIDEBAR --}}
		</div> {{-- ENDROW --}}
	</div>{{-- ENDCONTAINER --}}

	<script src="{{ URL::asset('assets/js/owl.js') }}"></script>
</body>

</html>