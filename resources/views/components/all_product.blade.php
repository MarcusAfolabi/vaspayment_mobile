<!-- <section class="categories-section section-b-space">
    <div class="custom-container">
        <div class="title w-border">
            <h2></h2>
            <a wire:navigate href="{{ route('product.all') }}">See more</a>
        </div>
        <ul class="categories-list">
            <li>
                <a wire:navigate href="{{ route('product.airtime.index') }}">
                    <div class="categories-box">
                        <img src="{{ asset('assets/feather/smartphone.svg') }}" />
                    </div>
                    <h5 class="mt-2 text-center">Airtime</h5>
                </a>
            </li>
            <li>
                <a wire:navigate href="{{ route('product.data.index') }}">
                    <div class="categories-box">
                        <img src="{{ asset('assets/feather/wifi.svg') }}" />
                    </div>
                    <h5 class="mt-2 text-center">Data</h5>
                </a>
            </li>
            <li>
                <a wire:navigate href="{{ route('product.power.index') }}">
                    <div class="categories-box">
                        <img src="{{ asset('assets/feather/zap.svg') }}" />
                    </div>
                    <h5 class="mt-2 text-center">Power</h5>
                </a>
            </li>
            <li>
                <a wire:navigate href="{{ route('product.cable.index') }}">
                    <div class="categories-box">
                        <img src="{{ asset('assets/feather/tv.svg') }}" />
                    </div>
                    <h5 class="mt-2 text-center">Cable</h5>
                </a>
            </li>
        </ul>
    </div>
</section> -->
<section>
    <div class="custom-container">
        <div class="title w-border">
            <h2>Utility</h2>
        </div>

        <div class="row gy-3">
            <div class="col-3">
                <a wire:navigate href="{{ route('product.airtime.index') }}">
                    <div class="service-box">
                        <img src="{{ asset('assets/feather/smartphone.svg') }}" />
                    </div>
                    <h5 class="mt-2 text-center theme-color">Airtime</h5>
                </a>
            </div>

            <div class="col-3">
                <a wire:navigate href="{{ route('product.data.index') }}">
                    <div class="service-box">
                        <img src="{{ asset('assets/feather/wifi.svg') }}" />
                    </div>
                    <h5 class="mt-2 text-center theme-color">Data</h5>
                </a>
            </div>
            <div class="col-3">
                <a wire:navigate href="{{ route('product.power.index') }}">
                    <div class="service-box">
                        <img src="{{ asset('assets/feather/zap.svg') }}" />
                    </div>
                    <h5 class="mt-2 text-center theme-color">Power</h5>
                </a>
            </div>

            <div class="col-3">
                <a wire:navigate href="{{ route('product.cable.index') }}">
                    <div class="service-box">
                        <img src="{{ asset('assets/feather/tv.svg') }}" />
                    </div>
                    <h5 class="mt-2 text-center theme-color">Cable</h5>
                </a>
            </div>

            <div class="col-3">
                <a wire:navigate href="{{ route('product.transfer.index') }}">
                    <div class="service-box">
                        <img src="{{ asset('assets/feather/navigation.svg') }}" />
                    </div>
                    <h5 class="mt-2 text-center theme-color">Transfer</h5>
                </a>
            </div>
        </div>
    </div>
</section>