@extends('layouts.master')

@section('styles')
    <link href="{{ asset('css/pages/about_developer.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <p class="about-title lead text-center">{{ __('pages/about_developer.About Developer') }}</p>
            <div class="row">
                <div class="col-lg-4">
                    <img class="rounded-circle image" src="{{ asset('images/main/about_developer.jpg') }}" alt="Fadi Krdiyeh">
                </div>
                <div class="col-lg-8">
                    <div class="lead info-text">
                        <div class="name">{{ __('pages/about_developer.Fadi Krdiyeh...') }}</div>
                        <div class="inner-text">{{ __('pages/about_developer.Full-stack Web Developer.') }}<br />{{ __("pages/about_developer. I'm ") . $age . __('pages/about_developer. years old, from Syria/Hama.')}}<br />{{ __('pages/about_developer.This web site is one of my special projects.') }}</div>
                        <div class="list-title">{{ __('pages/about_developer.My languages and skills:') }}</div>
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="list-unstyled lead info-list">
                                    <li><i class="fa fa-check"></i> HTML</li>
                                    <li><i class="fa fa-check"></i> CSS</li>
                                    <li><i class="fa fa-check"></i> SASS</li>
                                    <li><i class="fa fa-check"></i> Bootstrap</li>
                                    <li><i class="fa fa-check"></i> JavaScript</li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul class="list-unstyled lead info-list">
                                    <li><i class="fa fa-check"></i> jQuery</li>
                                    <li><i class="fa fa-check"></i> Vue.js</li>
                                    <li><i class="fa fa-check"></i> AJAX</li>
                                    <li><i class="fa fa-check"></i> JSON</li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul class="list-unstyled lead info-list">
                                    <li><i class="fa fa-check"></i> PHP</li>
                                    <li><i class="fa fa-check"></i> Database & SQL</li>
                                    <li><i class="fa fa-check"></i> Laravel</li>
                                    <li><i class="fa fa-check"></i> Git & Github</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="contact-me">
        <div class="contact-title text-center">{{ __('pages/about_developer.Contact Me') }}</div>
        <div class="color"></div>
        <div class="color"></div>
        <div class="color"></div>
        <div class="color"></div>
        <ul class="contact-list">
            <li class="soical-item" data-contact="Facebook:<br />Fadi Krdiyeh"><a href="https://www.facebook.com/Fadi.Krdiyeh/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li class="soical-item" data-contact="Telegram:<br />fadi_krdiyeh / +963 938123636"><a href="#"><i class="fa fa-paper-plane soical-icon" aria-hidden="true"></i></a></li>
            <li class="soical-item" data-contact="Instagram:<br />fadi_krdiyeh"><a href="https://www.instagram.com/fadi_krdiyeh/"><i class="fa fa-instagram soical-icon" aria-hidden="true"></i></a></li>
            <li class="soical-item" data-contact="E-mail <br />fadika666@gmail.com"><a href="#"><i class="fa fa-at soical-icon" aria-hidden="true"></i></a></li>
            <li class="soical-item" data-contact="WhatsApp And Phone Number:<br />+963 938123636"><a href="#"><i class="fa fa-whatsapp soical-icon" aria-hidden="true"></i></a></li>
        </ul>
        <div class="view-content text-center"></div>
    </section>
@endsection
@section('scripts')
    <script>
        $('.soical-item').hover(function (){
            let content = $(this).attr('data-contact');
            $('.view-content').fadeOut(function (){
                $('.view-content').html(content).fadeIn(1000)
            });
        }, function (){
            $('.view-content').fadeOut(500, function (){
                $('.view-content').html('');
            });
        });
    </script>
@endsection