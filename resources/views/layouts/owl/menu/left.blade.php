@if (Auth::check())

{{-- ADMIN MENU --}}
@if (Auth::user()->isAdmin())
<div class="leftmenu">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-title">
				Admin Panel
			</h4>
		</div>
		<div class="panel-body">
			<div>
				<a href="{{ route('dashboard') }}">Dashboard</a>
			</div>
		</div>
	</div>
</div>
@endif

{{-- #ACCOUNT MENU --}}
<div class="leftmenu">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-title">
				Account
			</h4>
		</div>
		<div class="panel-body">
			<div>
				<a href="{{ route('account.index') }}">Account Management</a>
			</div>
			<div>
				<a href="{{ route('auth.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
					Logout
				</a>
				{!! Form::open(['route' => 'auth.logout', 'id' => 'logout-form', 'style' => 'display:none;']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@else

{{-- #LOGIN AND REGISTER BUTTONS --}}
<div class="text-center">
	<div class="btn-group login-area">
		<a href="{{ route('auth.login') }}" class="btn btn-primary">Login</a> 
		<a href="{{ route('account.create') }}" class="btn btn-warning">Register</a>
	</div>
</div>
@endif

{{-- #LEFTMENU --}}

<div class="panel-group">
	<div id="leftmenu" class="leftmenu">

		{{-- #NEWSMENU --}}
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#leftmenu" href="#collapse1">News</a>
				</h4>
			</div>
			<div id="collapse1" class="panel-collapse collapse in">
				<div class="panel-body">
					<div>
						<a href="{{ route('home') }}">Latest News</a>
					</div>
					<div>
						<a href="">News Archive</a>
					</div>
				</div>
			</div>
		</div> {{-- END #NEWSMENU --}}

		{{-- #COMMUNITYMENU --}}
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#leftmenu" href="#collapse2">Community</a>
				</h4>
			</div>
			<div id="collapse2" class="panel-collapse collapse">
				<div class="panel-body">
					<div>
						<a href="{{ route('player.index') }}">Characters</a>
					</div>
					<div>
						<a href="">Guilds</a>
					</div>
				</div>
			</div>
		</div> {{-- END #COMMUNITYMENU --}}

		{{-- #SHOPMENU --}}
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#leftmenu" href="#collapse3">Shop</a>
				</h4>
			</div>
			<div id="collapse3" class="panel-collapse collapse">
				<div class="panel-body">
					<div>
						<a href="">Donate</a>
					</div>
					<div>
						<a href="">SHOP</a>
					</div>
				</div>
			</div>
		</div> {{-- END #SHOPMENU --}}
		
	</div>
</div> {{-- END #LEFTMENU --}}
