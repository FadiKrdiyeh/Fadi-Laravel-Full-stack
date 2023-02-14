@extends('layouts.master')

@section('styles')
    <link href="{{ asset('css/pages/themes.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h3 class="text-center theme-title">{{ __('pages/about_website.Change Themes') }}</h3>
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-6 mb-5">
                <div class="theme-box dark-theme mx-auto" data-value="{{ asset('css/layouts/themes/dark_theme.css') }}" data-name="dark-theme"></div>
                <h5 class="lead text-center mt-3">Dark</h5>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 mb-5">
                <div class="theme-box light-theme mx-auto" data-value="{{ asset('css/layouts/themes/light_theme.css') }}" data-name="light-theme"></div>
                <h5 class="lead text-center mt-3">Light</h5>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/themes.js') }}"></script>
@endsection