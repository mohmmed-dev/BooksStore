<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{str_replace('_', '-', app()->getLocale()) == 'ar' ? 'rtl' : 'ltr'}}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <style>
            @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
            .score .start-active {
                display: block;
                overflow: hidden;
            }
            .rating {
                overflow: hidden;
                display: inline-block;
                position: relative;
            }
            .rating-star {
                padding: 0 5px;
                margin: 0;
                cursor: pointer;
                display: block;
                float: left;
            }
            .rating-star.checked ~ .rating-star ,
            .rating-star.checked {
                color: #fbbf24;
            }
            .rating-star:hover  ~ .rating-star,
            .rating-star:hover{
                color: #fbbf24;
            }
            .StripeElement {
                box-sizing: border-box;
                height: 40px;
                padding: 10px 12px;
                border: 1px solid transparent;
                border-radius: 4px;
                background-color: white;
                box-shadow: 0 1px 3px 0 #e6ebf1;
                -webkit-transition: box-shadow 150ms ease;
                transition: box-shadow 150ms ease;
            }
            .StripeElement--focus {
                box-shadow: 0 1px 3px 0 #cfd7df;
            }
            .StripeElement--invalid {
                border-color: #fa755a;
            }
            .StripeElement--webkit-autofill {
                background-color: #fefde5 !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>

        @stack('modals')

        <!-- Font Awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
        @livewireScripts
        @yield('script')
    </body>
</html>
