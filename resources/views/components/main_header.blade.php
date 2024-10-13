<header class="section-t-space">
    <div class="custom-container">
        <div class="header-panel">
            <a class="sidebar-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft">
                <img src="{{ asset('assets/feather/menu.svg') }}" />
            </a>
            <img class="img-fluid logo" src="{{ asset('assets/logo_web.png') }}" alt="logo" />

            <a wire:navigate.hover href="{{ route('user.notification') }}" class="notification">
                <img src="{{ asset('assets/feather/bell.svg') }}" />
            </a>
            <!-- <h2>@yield('title')</h2> -->
        </div>
    </div>
</header>
@livewire('menu.side-bar')
<x-footerMenu />