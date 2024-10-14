<header class="section-t-space">
    <div class="custom-container">
        <div class="header-panel">
            <a class="sidebar-btn" href="{{ url()->previous() }}">
                <img src="{{ asset('assets/feather/arrow-left.svg') }}" />
            </a> 
            <h2>@yield('title')</h2>
        </div>
    </div>
</header>
<x-footerMenu />