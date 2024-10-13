 <section>
     @if ($transactions)
     <div class="custom-container">

         <div class="title">
             <h2>Transactions</h2>
             <a href="{{ route('all.transactions') }}">See more</a>
         </div>

         <div class="row gy-3">
             @foreach($transactions as $key => $transaction)
             @php
             if ($key == 2) break;
             $amountParts = explode('.', number_format($transaction['amount'], 2));
             $createdDate = \Carbon\Carbon::parse($transaction['created_at']);

             if ($createdDate->isToday()) {
             $formattedDate = 'Today ' . $createdDate->format('g:i a');
             } elseif ($createdDate->isYesterday()) {
             $formattedDate = 'Yesterday ' . $createdDate->format('g:i a');
             } else {
             $formattedDate = $createdDate->format('D d/m'); // e.g., "Fri 16/04/2024"
             }
             @endphp

             <div class="col-12">
                 <div class="transaction-box">
                     <a href="#latest-detail-{{ $transaction['id'] }}" data-bs-toggle="modal" class="d-flex gap-3">
                         <div class="transaction-image">
                             @if ($transaction['network'] == 'MTN')
                             <img src="{{ asset('assets/images/networks/mtn.png') }}" style="height: 30px; width: 30px;" />
                             @elseif ($transaction['network'] == 'AIRTEL')
                             <img src="{{ asset('assets/images/networks/airtel.png') }}" style="height: 30px; width: 30px;" />
                             @elseif ($transaction['network'] == 'GLO')
                             <img src="{{ asset('assets/images/networks/glo.png') }}" style="height: 30px; width: 30px;" />
                             @elseif ($transaction['network'] == '9MOBILE')
                             <img src="{{ asset('assets/images/networks/9mobile.png') }}" style="height: 30px; width: 30px;" />
                             @else
                             <img src="{{ asset('assets/images/logo/favicon.png') }}" style="height: 30px; width: 30px;" />
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
                                 <h5 class="light-text">{{ $formattedDate }}</h5>
                             </div>
                         </div>
                     </a>
                 </div>
             </div>

             <!-- Modal for each transaction -->
             @php
             $createdAt = \Carbon\Carbon::parse($transaction['created_at']);
             @endphp
             <div class="modal successful-modal transfer-details fade" id="latest-detail-{{ $transaction['id'] }}" tabindex="-1">
                 <div class="modal-dialog modal-dialog-centered">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h2 class="modal-title">Transaction Detail</h2>
                         </div>
                         <div class="modal-body">
                             <ul class="details-list">
                                 <li>
                                     <h3 class="fw-normal dark-text">Payment status</h3>
                                     <h3 class="fw-bold success-color">Success</h3>
                                 </li>
                                 <li>
                                     <h3 class="fw-normal dark-text">Date</h3>
                                     <h3 class="fw-normal light-text">{{ $createdAt->format('d F, Y') }}</h3>
                                 </li>
                                 <li>
                                     <h3 class="fw-normal dark-text">Sender</h3>
                                     <h3 class="fw-normal light-text">You ({{ $userName }})</h3>
                                 </li>
                                 <li>
                                     <h3 class="fw-normal dark-text">Category</h3>
                                     <h3 class="fw-normal light-text">{{ $transaction['network'] }} {{ $transaction['type'] }}</h3>
                                 </li>
                                 <li>
                                     <h3 class="fw-normal dark-text">Detail</h3>
                                     <h3 class="fw-normal light-text text-end justify-content-end">
                                         {{ isset($transaction['destination']) ? substr($transaction['destination'], 0, 60) : '' }}
                                     </h3>
                                 </li>
                                 <li class="amount">
                                     <h3 class="fw-normal dark-text">Amount</h3>
                                     <h3 class="fw-semibold success-color">₦{{ number_format($transaction['amount'], 2) }}</h3>
                                 </li>
                             </ul>
                         </div>
                         <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                             <img src="{{ asset('assets/feather/x.svg') }}" />
                         </button>
                     </div>
                 </div>
             </div>
             @endforeach
         </div>
     </div>
     @else
     <h3 class="d-block fw-normal dark-text text-center mt-3">There is no transaction record for now</h3>
     @endif

     <section class="panel-space"></section>

 </section>