<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Default'))</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @yield('headerScripts')

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        @yield('styles')
        @if (App::isLocale('ar'))
            <link href="{{ asset('css/layouts/rtl.css') }}" rel="stylesheet">
        @endif
        <link href="{{ asset('css/layouts/themes/dark_theme.css') }}" rel="stylesheet">
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous"> --}}

        <!--[if lt IE 9]>
            <script src="js/html5shiv.min.js"></script>
            <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}">
        <div id="app">

            {{-- Start Header --}}
            @include('layouts.includes.header')
            {{-- End Header --}}

            <main class="py-4">
                @yield('content')
            </main>

            @include('layouts.includes.sidebar')
            
        </div>

        {{-- Start Footer --}}
        @yield('footer')
        {{-- End Footer --}}

        {{-- Start Loading --}}
        @include('layouts.includes.loading')
        {{-- End Loading --}}

        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        @yield('scripts')
    </body>
</html>
