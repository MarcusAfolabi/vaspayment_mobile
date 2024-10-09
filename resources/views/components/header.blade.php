<header class="section-t-space">
    <div class="custom-container">
        <div class="header-panel">
            <a class="sidebar-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft">
                <img src="{{ asset('assets/feather/menu.svg') }}" />
            </a>
            <img class="img-fluid logo" src="{{ asset('assets/images/logo/logo.png') }}" alt="logo" />
            <a wire:navigate.hover href="#" class="notification">
                <img src="{{ asset('assets/feather/bell.svg') }}" />
            </a>
        </div>
    </div>
</header>

@livewire('menu.side-bar')