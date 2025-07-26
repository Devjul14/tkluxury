<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Home') | {{ config('app.name', 'Hosteller') }}</title>
        
        <!-- Meta tags -->
        @yield('meta')
        
        <!-- Preload scripts -->
        <script id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflS50iB-/www-widgetapi.js" async=""></script>
        <script src="https://www.youtube.com/player_api"></script>
        
        <!-- Preload stylesheets -->
        <link rel="stylesheet preload" as="style" href="{{ asset('asset/css/preload.min.css') }}" />
        <link rel="stylesheet preload" as="style" href="{{ asset('asset/css/icomoon.css') }}" />
        <link rel="stylesheet preload" as="style" href="{{ asset('asset/css/libs.min.css') }}" />

        <!-- Main stylesheet -->
        <link rel="stylesheet" href="{{ asset('asset/css/' . ($page ?? 'index') . '.min.css') }}" />
        
        <!-- Additional stylesheets -->
        @stack('styles')
    </head>
    <body>
        @include('layouts.partials.header')
        
        <!-- Main content -->
        <main>
            @yield('content')
        </main>
        
        <!-- Video modal -->
        <div class="video d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="video_frame d-flex align-items-center justify-content-center">
                    <i class="icon-close video_frame-close"></i>
                    <div id="player"></div>
                </div>
            </div>
        </div>
        
        @include('layouts.partials.footer')
        
        <!-- Scripts -->
        <script src="{{ asset('asset/js/common.min.js') }}"></script>
        @stack('scripts')
    </body>
</html> 