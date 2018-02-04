@extends('layouts.master')

@section('title', @trans('words.recovery_rey'))
@section('header', @trans('words.recovery_rey'))

@section('content')
    <h1 class="text-center">{{ $key }}</h1>
    <hr>
    <p>
        @lang('words.recovery_rey_msg')
    </p>
    <div class="text-center">
        {!! link_to_route('account.index', @trans('words.back_to_account'), [], ['class' => 'btn btn-primary']) !!}
    </div>
@endsection