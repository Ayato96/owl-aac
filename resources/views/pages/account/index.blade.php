@extends('layouts.master')

@section('title', @trans('words.account_management'))
@section('header', @trans('words.account_management'))

@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">@lang('words.account_info')</div>
        <div class="panel-body padding-0">
            <table class="table table-hover table-bordered table-striped margin-bottom-5">
                <tr>
                    <td class="col-md-3">@lang('words.account_name'):</td>
                    <td>{{ $account->name }}</td>
                </tr>
                <tr>
                    <td class="col-md-3">Email:</td>
                    <td>{{ $account->email }}</td>
                </tr>
                <tr>
                    <td class="col-md-3">@lang('words.account_info'):</td>
                    <td>
                        @if ($account->premdays>0)
                            Premium Account
                        @else
                            Free Account
                        @endif
                    </td>
                </tr>
            </table>
            <div class="text-center margin-bottom-5">
                {!! link_to_route('account.change.password', @trans('words.change_password'), [], ['class' => 'btn btn-primary btn-sm']) !!}
                <a href="account/change/email" class="btn btn-primary btn-sm">@lang('words.change_email')</a>
                @if (!$account->key)
                    {!! link_to_route('account.show.key', @trans('words.generate_key'), [], ['class' => 'btn btn-warning btn-sm']) !!}
                @endif
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading"> @lang('words.characters') </div>
        <div class="panel-body padding-0">
            <table class="table table-hover table-bordered table-striped margin-bottom-5">
                @if ($players->isEmpty())
                    <div class="text-center">
                        @lang('words.no_characters')
                    </div>
                @else
                    <tr>
                        <th></th>
                        <th>@lang('words.name')</th>
                        <th>@lang('words.vocation')</th>
                        <th>@lang('words.level')</th>
                        <th></th>
                    </tr>
                @endif
                @foreach ($players as $player)
                    <tr>
                        <td class="col-md-1">{{ $loop->iteration }}.</td>
                        <td>{{ $player->name }}</td>
                        <td>{{ $player->vocation }}</td>
                        <td>{{ $player->level }}</td>
                        <td class="col-md-3">
                            <div class="text-center">
                                {!! link_to_route('player.edit', @trans('words.edit'),
                                    [$player->id], ['class' => 'btn btn-primary btn-xs']) !!}
                                @if (!$player->trashed())
                                    {!! link_to_route('player.delete', @trans('words.delete'),
                                        [$player->id], [
                                            'class' => 'btn btn-danger btn-xs',
                                            'onclick'=>"return confirm('Do you really want to delete this character??')",
                                            ]) !!}
                                @else
                                    {!! link_to_route('player.restore', 'Restore',
                                        [$player->id], ['class' => 'btn btn-warning btn-xs','onclick'=>"return confirm('Are you sure?')"]) !!}
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="pull-right margin-bottom-5 margin-right-5">
                <a href="{{ route('player.create') }}" class="btn btn-primary btn-sm">@lang('words.create')</a>
            </div>
        </div>
    </div>
    @if(!$account->playersOnlyTrash->isEmpty())
        <div class="panel panel-primary">
            <div class="panel-heading">@lang('words.deleted_characters')</div>
            <div class="panel-body padding-0">
                <table class="table table-hover table-bordered table-striped margin-bottom-5">
                    <tr>
                        <th></th>
                        <th>@lang('words.name')</th>
                        <th>@lang('words.deletion_date')</th>
                        <th>@lang('words.level')</th>
                        <th></th>
                    </tr>
                    @foreach ($account->playersOnlyTrash as $player)
                        <tr>
                            <td class="col-md-1">{{ $loop->iteration }}.</td>
                            <td>{{ $player->name }}</td>
                            <td>{{ $player->deletion->addWeeks(2) }}</td>
                            <td>{{ $player->level }}</td>
                            <td class="col-md-3">
                                <div class="text-center">
                                    {!! link_to_route('player.restore', @trans('words.restore'),
                                        [$player->id], ['class' => 'btn btn-warning btn-xs','onclick'=>"return confirm('Are you sure?')"]) !!}

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif

@endsection