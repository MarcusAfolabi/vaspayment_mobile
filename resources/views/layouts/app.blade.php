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
    <link rel="manifest" href="{{ asset('manifest.json') }}" />
    <link rel="icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon" />
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo/favicon.png') }}" />
    <meta name="theme-color" content="#720E91" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="{{ env('APP_NAME') }}" />
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
    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
    <meta name="google-site-verification" content="uhIen3ZQPL0dIOdQzY4pSdjQC_tJXMV5UN-OiLHW-e8" />
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6487824117243144" crossorigin="anonymous"></script>
</head>

<body class="{{ Route::is('home', 'login', 'register', 'forget-password') ? 'auth-body' : '' }}">



    @yield('main')
    <p class="text-danger" wire:offline>
        Whoops, your device has lost connection.
    </p>
    @livewireScripts

    {{-- Error Modal --}}
    @if (session('error'))
    <div class="modal error-modal fade" id="error" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Oops!</h2>
                </div>
                <div class="modal-body">
                    <div class="error-img">
                        <img class="img-fluid" src="{{ asset('assets/images/svg/error.svg') }}" alt="error" />
                    </div>
                    <h3 class="pb-0 mt-2">{{ session('error') }}</h3>
                </div>
                <button type="button" class="btn close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/feather/x.svg') }}" />
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- Success Modal --}}
    @if (session('success'))
    <div class="modal successful-modal fade" id="done" tabindex="-1" aria-labelledby="doneModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Successfully</h2>
                </div>
                <div class="modal-body">
                    <div class="done-img">
                        <img class="img-fluid" src="{{ asset('assets/images/svg/done.svg') }}" alt="done" />
                    </div>
                    <h3 class="pb-0 mt-2">{{ session('success') }}</h3>
                </div>
                <button type="button" class="btn close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/feather/x.svg') }}" />
                </button>
            </div>
        </div>
    </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('error'))
            var errorModal = new bootstrap.Modal(document.getElementById('error'));
            errorModal.show();
            @elseif(session('success'))
            var successModal = new bootstrap.Modal(document.getElementById('done'));
            successModal.show();
            @endif
        });
    </script>
    
    <div x-data="{ idleTime: 0 }" x-init="setInterval(() => { idleTime++; if (idleTime >= 5) location.reload(); }, 60000)" @mousemove="idleTime = 0" @keydown="idleTime = 0">
    </div>
    
    <script rel="preload" src="{{ asset('assets/js/swiper-bundle.min.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script>
    <script rel="preload" src="{{ asset('assets/js/custom-swiper.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script>
    <script rel="preload" src="{{ asset('assets/js/feather.min.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script>
    <!-- <script rel="preload" src="{{ asset('assets/js/custom-feather.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script> -->
    <script rel="preload" src="{{ asset('assets/js/iconsax.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script>
    <script rel="preload" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" as="script" onload="this.onload=null;this.rel='script'"></script>
     <script rel="preload" src="{{ asset('assets/js/script.js') }}" as="script" onload="this.onload=null;this.rel='script'">
    </script>
    <script rel="script" src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>