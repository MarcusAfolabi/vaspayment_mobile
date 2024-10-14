<section class="categories-section section-b-space">
    <div class="custom-container">
        <div class="title">
            <h2></h2>
            <a href="#">See more</a>
        </div>
        <ul class="categories-list">
            <li>
                <a href="{{ route('airtime.index') }}">
                    <div class="categories-box">
                        <img src="{{ asset('assets/feather/smartphone.svg') }}" />
                    </div>
                    <h5 class="mt-2 text-center">Airtime</h5>
                </a>
            </li>
            <li>
                <a href="{{ route('data.index') }}">
                    <div class="categories-box">
                        <img src="{{ asset('assets/feather/wifi.svg') }}" />
                    </div>
                    <h5 class="mt-2 text-center">Data</h5>
                </a>
            </li>
            <li>
                <a href="{{ route('power.index') }}">
                    <div class="categories-box">
                        <img src="{{ asset('assets/feather/zap.svg') }}" />
                    </div>
                    <h5 class="mt-2 text-center">Power</h5>
                </a>
            </li>
            <li>
                <a href="{{ route('cable.index') }}">
                    <div class="categories-box">
                        <img src="{{ asset('assets/feather/tv.svg') }}" />
                    </div>
                    <h5 class="mt-2 text-center">Cable</h5>
                </a>
            </li>
        </ul>
    </div>
</section>