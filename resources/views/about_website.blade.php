@extends('layouts.master')

@section('styles')
    <link href="{{ asset('css/pages/about_website.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="main-title text-center">{{ __('Web Styles') }}</div>
        <div class="content">
            <div class="row justify-content-center text-center">
                <div class="col-lg-4 col-md-6">
                    <div class="about-website hvr-float-shadow"><div class="number hvr-wobble-top">1</div>{{ __('pages/about_website.This web site was designed by Fadi Krdiyeh...') }}</div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-website hvr-float-shadow"><div class="number hvr-wobble-top">2</div>{{ __('pages/about_website.Here you will find many advanced styles that have been published by the designer and many other people..') }}</div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-website hvr-float-shadow"><div class="number hvr-wobble-top">3</div>{{ __('pages/about_website.You can also publish your styles here..') }}</div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-website hvr-float-shadow"><div class="number hvr-wobble-top">4</div>{{ __('pages/about_website.Some of them are paid and others are free..') }}</div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-website hvr-float-shadow"><div class="number hvr-wobble-top">5</div>{{ __('pages/about_website.Free, You can copy the code directly..') }}</div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-website hvr-float-shadow"><div class="number hvr-wobble-top">6</div>{{ __('pages/about_website.As for the paid, you have to pay to display the code.') }}</div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-website hvr-float-shadow"><div class="number hvr-wobble-top">7</div>{{ __('pages/about_website.You can publish the styles..') }}</div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-website hvr-float-shadow"><div class="number hvr-wobble-top">8</div>{{ __('pages/about_website.When you publish one of the styles with each purchase of the style, your personal wallet for the site will become 50% of the price of the style..') }}</div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-website hvr-float-shadow"><div class="number hvr-wobble-top">9</div>{{ __('pages/about_website.You can get money from wallet any time..') }}</div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-website hvr-float-shadow"><div class="number hvr-wobble-top">10</div>{{ __('pages/about_website.Login and go to publish the styles to profit from them..') }}</div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-website hvr-float-shadow"><div class="number hvr-wobble-top">11</div>{{ __('pages/about_website.Make it awesome to be accepted and get more money...') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('layouts.includes.footer')
@endsection