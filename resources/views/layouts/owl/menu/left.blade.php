@if (Auth::check())

	<div id="leftmenu">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">
					Account
				</h4>
			</div>
			<div class="panel-body">
				<div>
					<a href="/account">Account Management</a>
				</div>
				<div>
					<a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
						Logout
					</a>
					{!! Form::open(['action' => 'AuthController@logout', 'id' => 'logout-form', 'style' => 'display:none;']) !!}
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>

@else

	<div class="text-center">
		<div class="btn-group login-area">
			<a href="login" class="btn btn-primary">Login</a> 
			<a href="account/create" class="btn btn-warning">Register</a>
		</div>
	</div>

@endif

<div class="panel-group" id="leftmenu">

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#leftmenu" href="#collapse1">News</a>
			</h4>
		</div>
		<div id="collapse1" class="panel-collapse collapse in">
			<div class="panel-body">
				<div>
					<a href="">Latest News</a>
				</div>
				<div>
					<a href="">News Archive</a>
				</div>
			</div>
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#leftmenu" href="#collapseTwo">Community</a>
			</h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse">
			<div class="panel-body">
				<div>
					<a href="">Characters</a>
				</div>
				<div>
					<a href="">Guilds</a>
				</div>
			</div>
		</div>
	</div>

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
	</div>
</div>