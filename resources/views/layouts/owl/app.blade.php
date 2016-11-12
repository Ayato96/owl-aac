<!DOCTYPE html>
<html>
<head>
	<title>Owl - @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/bootstrap-theme.min.css') }}">

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<style type="text/css">
				body {
					background-color: #F5F5F5;
				}
				#leftmenu .panel-body {
					padding: 0;
				}
				#leftmenu .panel .panel-body div {
					border-top-width: 1px;
					border-top-style: solid;
					border-top-color: #ddd;
				}
				#leftmenu .panel a {
					display: block;
					text-decoration: none;
				}
				#leftmenu .panel .panel-body a {
					padding: 8px;
				}
				.login-area{
					margin-bottom: 10px;
				}
				.carousel-main-text
				{
					position: absolute;
					top: 10px;
					width: 96.66666666666666%;
					color: #FFF;
				}

			</style>
			{{-- HEADER --}}
			<div class="col-md-10 col-md-offset-1" style="margin-bottom: 10px;">
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
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
</body>

</html>