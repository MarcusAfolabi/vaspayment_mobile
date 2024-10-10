<div>
    <section class="section-b-space">
        <div class="custom-container">
            <div class="card-box">
                <div class="card-details">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-semibold">Wallet Balance</h5>
                        <img src="{{ asset('assets/images/svg/ellipse.svg') }}" alt="ellipse" />
                    </div>

                    <h1 class="mt-2 text-white">&#8358;{{ $balance }}</h1>

                    <div class="amount-details">
                        <div class="amount w-50 text-start">
                            <div class="d-flex align-items-center justify-content-start">
                                <h3 class="text-white"> &#8358;{{ $commission }}</h3>
                            </div>
                            <h5>Commission</h5>
                        </div>
                        <div class="amount w-50 text-end border-0">
                            <div class="d-flex align-items-center justify-content-end">
                                <h3 class="text-white">&#8358;{{ $bonus ?? '0' }}</h3>
                            </div>
                            <h5>Referral Bonus</h5>
                        </div>
                    </div>
                </div>
                <a wire:navigate.hover href="{{ route('virtual.account') }}" class="add-money theme-color"
                    data-bs-toggle="modal"> Fund Wallet</a>
            </div>
        </div>
    </section>
</div>
