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
                    @lang('words.account')
                </h4>
            </div>
            <div class="panel-body">
                <div>
                    <a href="{{ route('account.index') }}">@lang('words.account_management')</a>
                </div>
                <div>
                    <a href="{{ route('auth.logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        @lang('words.logout')
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
            <a href="{{ route('auth.login') }}" class="btn btn-primary">@lang('words.login')</a>
            <a href="{{ route('account.create') }}" class="btn btn-warning">@lang('words.register')</a>
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
                    <a data-toggle="collapse" data-parent="#leftmenu" href="#collapse1">@lang('words.news')</a>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div>
                        <a href="{{ route('home') }}">@lang('words.latest_news')</a>
                    </div>
                    <div>
                        <a href="">@lang('words.news_archive')</a>
                    </div>
                </div>
            </div>
        </div> {{-- END #NEWSMENU --}}

        {{-- #COMMUNITYMENU --}}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#leftmenu" href="#collapse2">@lang('words.community')</a>
                </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">
                    <div>
                        <a href="{{ route('player.index') }}">@lang('words.characters')</a>
                    </div>
                    <div>
                        <a href="{{ route('guild.index') }}">@lang('words.guilds')</a>
                    </div>
                </div>
            </div>
        </div> {{-- END #COMMUNITYMENU --}}

        {{-- #SHOPMENU --}}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#leftmenu" href="#collapse3">@lang('words.shop')</a>
                </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
                <div class="panel-body">
                    <div>
                        <a href="">@lang('words.donate')</a>
                    </div>
                    <div>
                        <a href="">@lang('words.shop')</a>
                    </div>
                </div>
            </div>
        </div> {{-- END #SHOPMENU --}}

    </div>
</div> {{-- END #LEFTMENU --}}
