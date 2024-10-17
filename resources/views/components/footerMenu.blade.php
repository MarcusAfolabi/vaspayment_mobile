<div class="navbar-menu">
    <div class="scanner-bg">
        <a data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft" class="scanner-btn" wire:navigate>
            <img class="img-fluid" src="{{ asset('assets/images/svg/scan.svg') }}" alt="scan" />
        </a>
    </div>

    <ul>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" wire:navigate>
                <div class="icon">
                    <img class="unactive" src="{{ asset('assets/images/svg/mpay.svg') }}" alt="mPay" />
                    <img class="active" src="{{ asset('assets/images/svg/mpay-fill.svg') }}" alt="mPay" />
                </div>
                <h5>vPay</h5>
            </a>
        </li>

        <li class="{{ request()->routeIs('product.*') ? 'active' : '' }}">
            <a href="{{ route('product.all') }}" wire:navigate>
                <div class="icon">
                    <img class="unactive" src="{{ asset('assets/images/svg/bitcoin.svg') }}" alt="categories" />
                    <img class="active" src="{{ asset('assets/images/svg/bitcoin-fill.svg') }}" alt="categories" />
                </div>
                <h5>Utility</h5>
            </a>
        </li>


        <li></li>

        <li>
            <a href="#" wire:navigate>
                <div class="icon">
                    <img class="unactive" src="{{ asset('assets/images/svg/bar-chart.svg') }}" alt="bag" />
                    <img class="active" src="{{ asset('assets/images/svg/bar-chart-fill.svg') }}" alt="bag" />
                </div>
                <h5>Insight</h5>
            </a>
        </li>

        <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
            <a href="{{ route('user.profile') }}" wire:navigate>
                <div class="icon">
                    <img class="unactive" src="{{ asset('assets/images/svg/user.svg') }}" alt="profile" />
                    <img class="active" src="{{ asset('assets/images/svg/user-fill.svg') }}" alt="profile" />
                </div>
                <h5>Profile</h5>
            </a>
        </li>
    </ul>
</div>