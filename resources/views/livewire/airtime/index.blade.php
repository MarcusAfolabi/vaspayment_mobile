<div>
    <section>
        <div class="custom-container">
            <div class="crypto-wallet-box">
                <div class="card-details">
                    <div class="d-block w-75">
                        <h5 class="fw-semibold">Total Airtime Bought</h5>
                        <h2 class="mt-2">0.00</h2>
                    </div>
                    <div class="price-difference">
                        <a href="#pay" data-bs-toggle="modal" class="text-white fw-bold"> BUY
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="custom-container mt-4">
            <div class="title">
                <h5>Airtime History</h5>
            </div>

            <div class="row gy-3">
                <div class="col-12">
                    <div class="transaction-box">
                        <a href="#transaction-detail" data-bs-toggle="modal" class="d-flex gap-3">
                            <div class="transaction-image color1">
                                <img class="img-fluid icon" src="{{ asset('assets/images/svg/bitcoins.svg') }}" alt="bitcoins" />
                            </div>
                            <div class="transaction-details">
                                <div class="transaction-name">
                                    <h5>MTN </h5>
                                    <h3 class="dark-text success-color">N10</h3>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="light-text">Airtime</h5>
                                    <h5 class="success-color"> <span class="light-text">Today</span></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- pay modal starts -->
    <div class="modal pay-modal fade" id="pay" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Buy Airtime</h2>
                </div>
                @livewire('airtime.buy-airtime-form')
                <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                    <img src="{{ asset('assets/feather/x.svg') }}" />
                </button>
            </div>
        </div>
    </div>

    <!-- pay modal end -->

    <!-- transaction detail modal start -->
    <div class="modal successful-modal transfer-details fade" id="transaction-detail" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Transaction Detail</h2>
                </div>
                <div class="modal-body">
                    <ul class="details-list">
                        <li>
                            <h3 class="fw-normal dark-text">Payment status</h3>
                            <h3 class="fw-normal light-text">Success</h3>
                        </li>
                        <li>
                            <h3 class="fw-normal dark-text">Date</h3>
                            <h3 class="fw-normal light-text">18 May, 2023</h3>
                        </li>
                        <li>
                            <h3 class="fw-normal dark-text">From</h3>
                            <h3 class="fw-normal light-text">**** **** **** 2563</h3>
                        </li>
                        <li>
                            <h3 class="fw-normal dark-text">To</h3>
                            <h3 class="fw-normal light-text">Amazon prime</h3>
                        </li>
                        <li>
                            <h3 class="fw-normal dark-text">Transaction category</h3>
                            <h3 class="fw-normal light-text">Bill Pay</h3>
                        </li>
                        <li class="amount">
                            <h3 class="fw-normal dark-text">Amount</h3>
                            <h3 class="fw-semibold error-color">$199.99</h3>
                        </li>
                    </ul>
                </div>
                <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                    <img src="{{ asset('assets/feather/x.svg') }}" />
                </button>
            </div>
        </div>
    </div>
    <!-- transaction detail modal start -->

</div>