<div>
    <section>
        <div class="custom-container">
            @if ($virtual_transactions)
                <div class="title">
                    <h2>Funding History</h2>
                </div>
            <div class="row gy-3">
                @foreach ($virtual_transactions as $transaction)
                    <div class="col-12">
                        <div class="transaction-box">
                            <a href="#" class="d-flex gap-3">
                                <div class="transaction-image">
                                    @if (Str::startsWith($transaction['reference'], 'MNFY'))
                                        <img style="border-radius: 0.5rem;" class="img-fluid transaction-icon"
                                            src="{{ asset('assets/images/biller/monipoint.png') }}" alt="Monnify" />
                                    @else
                                        <img style="border-radius: 0.5rem;" class="img-fluid transaction-icon"
                                            src="{{ asset('assets/images/biller/wema_bank_logo.jpeg') }}"
                                            alt="Wema" />
                                    @endif
                                </div>
                                <div class="transaction-details">
                                    <div class="transaction-name">
                                        @if (Str::startsWith($transaction['reference'], 'MNFY'))
                                            <h5>Monnify</h5>
                                        @else
                                            <h5>Wema</h5>
                                        @endif
                                        <h3 class="success-color">
                                            &#8358;{{ number_format(floor($transaction['amount']), 0) }}.<span>{{ substr($transaction['amount'], -2) }}</span>
                                        </h3>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5 class="light-text">
                                            @if (\Carbon\Carbon::parse($transaction['created_at'])->isToday())
                                                {{ \Carbon\Carbon::parse($transaction['created_at'])->format('g:i a') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($transaction['created_at'])->format('D, M. d, Y') }}
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif

        </div>
    </section>

</div>
