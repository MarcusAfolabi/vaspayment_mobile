<header class="section-t-space">
    <div class="custom-container">
        <div class="header-panel">
            <a class="sidebar-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft">
                <i class="menu-icon" data-feather="menu"></i>
            </a>
            <img class="img-fluid logo" src="{{ asset('assets/images/logo/logo.png') }}" alt="logo" />
            <a wire:navigate.hover href="#" class="notification">
                <i class="notification-icon" data-feather="bell"></i>
            </a>
        </div>
    </div>
</header>

@livewire('menu.side-bar')
