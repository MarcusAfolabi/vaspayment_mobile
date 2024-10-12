<section>
    <div class="custom-container">
        <div class="title">
            <h2>All transactions</h2>
        </div>

        <div class="position-relative mb-4">
            <input type="search" wire:model.live='search' placeholder="Search your transactions" class="form-control px-5" />
            <img src="{{ asset('assets/feather/search.svg') }}" alt="Search" class="search-icon" />
        </div>
        <style>
            .position-relative {
                position: relative;
            }

            .search-input {
                padding-left: 40px;
                /* Adjust padding to make space for the icon */
            }

            .search-icon {
                position: absolute;
                left: 10px;
                /* Adjust based on your design */
                top: 50%;
                transform: translateY(-50%);
                /* Center the icon vertically */
                pointer-events: none;
                /* Prevent clicks on the icon */
            }
        </style>

        <div class="row gy-3">
            @php
            // Group transactions by date
            $groupedTransactions = [];
            foreach ($transactions as $transaction) {
            $createdDate = \Carbon\Carbon::parse($transaction['created_at']);

            if ($createdDate->isToday()) {
            $groupedTransactions['Today'][] = $transaction;
            } elseif ($createdDate->isYesterday()) {
            $groupedTransactions['Yesterday'][] = $transaction;
            } else {
            $formattedDate = $createdDate->format('D d-M-y'); // e.g., "Fri 16/04"
            $groupedTransactions[$formattedDate][] = $transaction;
            }
            }
            @endphp

            @foreach ($groupedTransactions as $dateLabel => $transactions)
            <div class="title justify-content-end">
                <h2>{{ $dateLabel }}</h2> <!-- Display the date group -->
            </div>

            @foreach ($transactions as $transaction)
            @php
            $amountParts = explode('.', number_format($transaction['amount'], 2));
            $transactionTime = \Carbon\Carbon::parse($transaction['created_at'])->format('g:i a');
            @endphp

            <div class="col-12">
                <div class="transaction-box">
                    <a href="#" class="d-flex gap-3">
                        <div class="transaction-image">
                            @if ($transaction['network'] == 'MTN' || $transaction['network'] == 'MTN CG' || $transaction['network'] == 'MTN SME' || $transaction['network'] == 'MTN SME2' || $transaction['network'] == 'MTN DG')
                            <img class="img-fluid transaction-icon" style="width: 40px; height: 40px;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/6c4afd16-a0df-b745-d0a3-b31a2d5e4d42.png">
                            @elseif ($transaction['network'] == 'GLO' || $transaction['network'] == 'GLO CG')
                            <img style="width: 40px; height: 40px;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/a20c3339-3def-d815-f61b-92d965b19f29.png">
                            @elseif ($transaction['network'] == '9MOBILE' || $transaction['network'] == '9MOBILE CG')
                            <img style="width: 40px; height: 40px;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/ca4bcec0-c996-f3cb-8c4b-fba81d2689c8.png">
                            @elseif ($transaction['network'] == 'AIRTEL DG' || $transaction['network'] == 'AIRTEL CG' || $transaction['network'] == 'AIRTEL')
                            <img style="width: 40px; height: 40px;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/93794ad5-0c13-1019-e12c-b65bf9fa235b.png">
                            @else
                            <img style="width: 40px; height: 40px;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/ca118e83-b696-4f3b-8769-975b004454b6.png">
                            @endif
                        </div>

                        <div class="transaction-details">
                            <div class="transaction-name">
                                <h5>{{ $transaction['network'] }} {{ $transaction['type'] }}</h5>
                                <h3 class="{{ $transaction['source'] == 'debit' ? 'text-danger' : 'text-success' }}">
                                    ₦{{ $amountParts[0] }}.<sub>{{ $amountParts[1] }}</sub>
                                </h3>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="light-text">{{ Str::limit($transaction['destination'], 10) }}</h5> <!-- Limit to 10 characters -->
                                <h5 class="light-text">{{ $transactionTime }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
            @endforeach
        </div>
        <section class="panel-space"></section>
    </div>
</section>