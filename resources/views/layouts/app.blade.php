<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Simplify your Bill Payments, Earn Commissions and get a Convenient, Hassle-Free Experience." />
    <meta name="keywords"
        content="mtn, glo, airtel, 9mobile, data, airtime, cable tv, electricity, nepa, ikeja, abuja, power, recharge card, waec, neco, scratch card." />
    <meta name="author" content="webshop technology" />
    <link rel="manifest" href="manifest.json" />
    <link rel="icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon" />
    <title>Welcome to VASPAYMENT</title>
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo/favicon.png') }}" />
    <meta name="theme-color" content="#720E91" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="vaspayment" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/images/logo/favicon.png') }}" />
    <meta name="msapplication-TileColor" content="#720E91" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />


    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/iconsax.css') }}" />
    <link rel="stylesheet" id="rtl-link" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" id="change-link" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css">
    <style>
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            src: url('assets/fonts/Inter.ttf') format('truetype');
        }
    </style>
    @livewireStyles
</head>
@if (Route::is('home', 'login', 'register', 'forget-password'))

    <body class="auth-body">
    @else

        <body>
@endif
@yield('main')
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/custom-swiper.js') }}"></script>

{{-- <script src="{{ asset('assets/js/feather.min.js') }}"></script> --}}
  <script src="{{ asset('assets/js/custom-feather.js') }}"></script>

<script src="{{ asset('assets/js/iconsax.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/js/offcanvas-popup.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

@livewireScripts
</body>

</html>
