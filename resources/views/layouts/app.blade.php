<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Simplify your Bill Payments, Earn Commissions and get a Convenient, Hassle-Free Experience." />
    <meta name="keywords" content="mtn, glo, airtel, 9mobile, data, airtime, cable tv, electricity, nepa, ikeja, abuja, power, recharge card, waec, neco, scratch card." />
    <meta name="author" content="webshop technology" />
    <link rel="manifest" href="manifest.json" />
    <link rel="icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon" />
    <title>Welcome to VASPAYMENT</title>
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo/favicon.png') }}" />
    <meta name="theme-color" content="#720E91" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="vaspayment" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/images/logo/favicon.png') }}" />
    <meta name="msapplication-TileColor" content="#720E91" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />


    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&amp;display=swap" rel="stylesheet" />
    <!-- Iconsax CSS -->
    <link rel="preload" href="{{ asset('assets/css/vendors/iconsax.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/css/vendors/bootstrap.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/css/vendors/swiper-bundle.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/css/style.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'" id="change-link">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" as="script" rel="preload" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @livewireStyles
</head>
@if (Route::is('home', 'login', 'register', 'forget-password'))

<body class="auth-body">
    @else

    <body>
        @endif
        @yield('main')
        @livewireScripts
        <!-- <style>
            .message-alert-style1 {
                position: fixed;
                top: 80px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 9999;
            }

            .alert {
                width: 300px;
                text-align: center;
                /* Optional: Center text */
            }
        </style> -->
        <!-- <div class="message-alert-style1 message-alart-style1"> -->

            @if (session('error'))
            <!-- <div class="fw-semibold bg-white alert alart_style_three alart_style_one alert-dismissible fade show mb20" role="alert" style="color: #C58B4B;">
                {{ session('error') }}
                <i class="far fa-xmark btn-close" data-bs-dismiss="alert" aria-label="Close"></i>
            </div> -->
            <div class="modal error-modal fade" id="error" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">Oops!</h2>
                        </div>
                        <div class="modal-body">
                            <div class="error-img">
                                <img class="img-fluid" src="assets/images/svg/error.svg" alt="error" />
                            </div>
                            <h3> {{ session('error') }}</h3>
                             
                        </div>
                        <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                            <i class="icon" data-feather="x"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endif
            @if (session('success'))
            <!-- <div class="fw-semibold alert alert_style_one alart_style_one alert-dismissible fade show mb20" role="alert" style="background-color: #C58B4B; color: white;">
                {{ session('success') }}
                <i class="far fa-xmark btn-close" data-bs-dismiss="alert" aria-label="Close"></i>
            </div> -->
            <div class="modal successful-modal fade" id="done" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">Successfully</h2>
                        </div>
                        <div class="modal-body">
                            <div class="done-img">
                                <img class="img-fluid" src="assets/images/svg/done.svg" alt="done" />
                            </div>
                            <h3 class="pb-0"> {{ session('success') }}</h3>
                        </div>
                        <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                            <i class="icon" data-feather="x"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endif

        <!-- </div> -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    let alerts = document.querySelectorAll('.alert');
                    alerts.forEach(function(alert) {
                        alert.classList.remove('show');
                        alert.classList.add('fade');
                    });
                }, 3500); // 4000 milliseconds = 4 seconds
            });
        </script>

        <script rel="preload" src="{{ asset('assets/js/swiper-bundle.min.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script>
        <script rel="preload" src="{{ asset('assets/js/custom-swiper.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script>
        <script rel="preload" src="{{ asset('assets/js/feather.min.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script>
        <script rel="preload" src="{{ asset('assets/js/custom-feather.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script>
        <script rel="preload" src="{{ asset('assets/js/iconsax.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script>
        <script rel="preload" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script>
        <script rel="preload" src="{{ asset('assets/js/homescreen-popup.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script>
        <script rel="preload" src="{{ asset('assets/js/offcanvas-popup.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script>
        <script rel="preload" src="{{ asset('assets/js/script.js') }}" as="script" onload="this.onload=null;this.rel='script'">
        </script>

 
    </body>

</html>