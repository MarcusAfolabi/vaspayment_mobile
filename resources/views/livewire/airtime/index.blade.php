<div>
    <section>
        <div class="custom-container">
            <div class="crypto-wallet-box">
                <div class="card-details">
                    <div class="d-block w-75">
                        <h5 class="fw-semibold">Total Airtime Bought</h5>
                        <h2 class="mt-2">{{ number_format($total,2) }}</h2>
                    </div>
                    <div class="price-difference">
                        <a href="#pay" data-bs-toggle="modal" class="text-white fw-bold"> BUY
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if ($transactions)


    <section>
        <div class="custom-container mt-4">
            <div class="title">
                <h4>Airtime History</h4>
            </div>
            <div class="row gy-3">
                @foreach ($transactions as $tx)
                <div class="col-12">
                    <div class="transaction-box">

                        <a href="#transaction-detail-{{ $tx['id'] }}" data-bs-toggle="modal" class="d-flex gap-3">
                            <div class="transaction-image color1">
                                @if ($tx['network'] == 'MTN')
                                <img src="{{ asset('assets/images/networks/mtn.png') }}" style="height: 30px; width: 30px;" />
                                @elseif ($tx['network'] == 'AIRTEL')
                                <img src="{{ asset('assets/images/networks/airtel.png') }}" style="height: 30px; width: 30px;" />
                                @elseif ($tx['network'] == 'GLO')
                                <img src="{{ asset('assets/images/networks/glo.png') }}" style="height: 30px; width: 30px;" />
                                @elseif ($tx['network'] == '9MOBILE')
                                <img src="{{ asset('assets/images/networks/9mobile.png') }}" style="height: 30px; width: 30px;" />
                                @else
                                <img src="{{ asset('assets/images/logo/favicon.png') }}" style="height: 30px; width: 30px;" />
                                @endif
                            </div>
                            <div class="transaction-details">
                                <div class="transaction-name">
                                    <h5>{{ $tx['network'] }} {{ $tx['type'] }}</h5>
                                    <h3 class="dark-text success-color">₦{{ $tx['amount'] }}</h3>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="light-text">{{ $tx['token'] }}</h5>
                                    @php
                                    $createdAt = \Carbon\Carbon::parse($tx['created_at']);
                                    @endphp

                                    <h6 class="success-color">
                                        @if ($createdAt->isToday())
                                        <span class="light-text">Today {{ $createdAt->format('h:i A') }}</span>
                                        @elseif ($createdAt->isYesterday())
                                        <span class="light-text">Yesterday {{ $createdAt->format('h:i A') }}</span>
                                        @else
                                        <span class="light-text">{{ $createdAt->format('h:i A d M, Y') }}</span>
                                        @endif
                                    </h6>
                                </div>
                            </div>
                        </a>
                        <!-- Modal for each transaction -->
                        <div class="modal successful-modal transfer-details fade" id="transaction-detail-{{ $tx['id'] }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title">Transaction Detail</h2>
                                    </div>
                                    <div class=" modal-body">
                                        <ul class="details-list">
                                            <li>
                                                <h3 class="fw-normal dark-text">Payment status</h3>
                                                <h3 class="fw-bold success-color">Success</h3>
                                            </li>
                                            <li>
                                                <h3 class="fw-normal dark-text">Date</h3>
                                                <h3 class="fw-normal light-text">{{ $createdAt->format('h:i A d M, Y') }}</h3>
                                            </li>
                                            <li>
                                                <h3 class="fw-normal dark-text">Sender</h3>
                                                <h3 class="fw-normal light-text">You ({{ $userName }})</h3>
                                            </li>
                                            @if ($tx['token'])

                                            <li>
                                                <h3 class="fw-normal dark-text">Receiver</h3>
                                                <h3 class="fw-normal light-text">{{ $tx['token'] }}</h3>
                                            </li>

                                            @endif
                                            <li>
                                                <h3 class="fw-normal dark-text">Category</h3>
                                                <h3 class="fw-normal light-text">{{ $tx['network'] }} {{ $tx['type'] }}</h3>
                                            </li>
                                            <li>
                                                <h3 class="fw-normal dark-text">Detail</h3>
                                                <h3 class="fw-normal light-text text-end justify-content-end">
                                                    {{ isset($tx['destination']) ? substr($tx['destination'], 0, 60) : '' }}
                                                </h3>
                                            </li>
                                            <li class="amount">
                                                <h3 class="fw-normal dark-text">Amount</h3>
                                                <h3 class="fw-semibold success-color">₦{{ number_format($tx['amount'], 2) }}</h3>
                                            </li>
                                        </ul>
                                    </div>
                                    <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                                        <img src="{{ asset('assets/feather/x.svg') }}" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
    @else
    <div class="custom-container">
        <div class="empty-page">
            <img class="notification-img" class="img-fluid" src="{{ asset('assets/images/svg/notification.svg') }}" alt="notification" />
            <h3 class="d-block fw-normal dark-text text-center mt-3">There is no airtime transaction available for you</h3>
        </div>
    </div>
    @endif
    <section class="panel-space"></section>

    <!-- pay modal starts -->
    <!-- Modal Markup -->
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

    <!-- Trigger Modal on Page Load -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('pay'));
            myModal.show();
        });
    </script>

</div>