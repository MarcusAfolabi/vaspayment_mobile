<header class="section-t-space">
    <div class="custom-container">
        <div class="header-panel">
            <a class="sidebar-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft">
                <img src="{{ asset('assets/feather/menu.svg') }}" />
            </a>
            <h2>@yield('title')</h2>
        </div>
    </div>
</header>
@livewire('menu.side-bar')