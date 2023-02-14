@extends('layouts.master')

@section('styles')
    <link href="{{ asset('css/pages/wallet.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container text-center">
        <div class="wallet-title">{{ $user -> name . ' ' . __('pages/about_website.Wallet') }}</div>
        <div class="lead title">{{ __('pages/about_website.Your Total Money Is:') }} {{ $user -> wallet }}$</div>
        <a href="#" class="btn btn-custom">{{ __('pages/about_website.Get All') }}</a>
    </div>
@endsection