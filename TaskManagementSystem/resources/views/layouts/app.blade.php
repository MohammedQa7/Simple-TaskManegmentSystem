<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        @notifyCss
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Styles -->
        @include('includes.header-style')
        @livewireStyles
        
    </head>
    <body class="g-sidenav-show  bg-gray-100">
        <x-banner />

        @include('includes.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            @include('includes.profile-navigator')
            {{ $slot }}
            
            <x-notify::notify />
        </main>

        @stack('modals')
        
        @livewireScripts
        
        @include('includes.script')     
        @yield('cdEditor')
       
   
    </body>

</html>
