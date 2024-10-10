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
                     <a href="#" class="d-flex gap-3">
                         <div class="transaction-image">
                             @if ($transaction['network'] == 'MTN' || $transaction['network'] == 'MTN CG' || $transaction['network'] == 'MTN SME' || $transaction['network'] == 'MTN SME2' || $transaction['network'] == 'MTN DG')
                             <img class="img-fluid transaction-icon" style="width: 40px; height: 40px; vertical-align: middle;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/6c4afd16-a0df-b745-d0a3-b31a2d5e4d42.png">
                             @elseif ($transaction['network'] == 'GLO' || $transaction['network'] == 'GLO CG')
                             <img style="width: 40px; height: 40px; vertical-align: middle;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/a20c3339-3def-d815-f61b-92d965b19f29.png">
                             @elseif ($transaction['network'] == '9MOBILE' || $transaction['network'] == '9MOBILE CG')
                             <img style="width: 40px; height: 40px; vertical-align: middle;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/ca4bcec0-c996-f3cb-8c4b-fba81d2689c8.png">
                             @elseif ($transaction['network'] == 'AIRTEL DG' || $transaction['network'] == 'AIRTEL CG' || $transaction['network'] == 'AIRTEL')
                             <img style="width: 40px; height: 40px; vertical-align: middle;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/93794ad5-0c13-1019-e12c-b65bf9fa235b.png">
                             @elseif ($transaction['network'] == 'IBEDC')
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/45a25ea3-9d27-e09b-77f6-0e3faf01ab50.jpg">
                             @elseif ($transaction['network'] == 'AEDC')
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/fc1744c6-6345-ff25-f9af-5a6694ca573c.jpg">
                             @elseif ($transaction['network'] == 'EEDC')
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/c415e190-cc96-f6e9-19e3-72d22e3f6df1.jpg">
                             @elseif ($transaction['network'] == 'EKEDC')
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/162c1ae7-4e0f-b1c1-71f5-10a6aa28694f.jpg">
                             @elseif ($transaction['network'] == 'IKEDC')
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/4f0cedd5-c42a-1504-0f86-13e000b4f6f8.jpg">
                             @elseif ($transaction['network'] == 'JEDC')
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/1418de44-3863-b27e-4bb1-e8fdc10d7f2b.jpg">
                             @elseif ($transaction['network'] == 'KAEDC')
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/d58b07af-d3c1-039b-aa23-51f21f66439d.jpg">
                             @elseif ($transaction['network'] == 'KEDC')
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/69be76d6-4b52-19df-0631-fe15f71bbf25.jpg">
                             @elseif ($transaction['network'] == 'PHEDC')
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/c11654bf-cd0f-76e9-465b-e8f091c66591.jpg">
                             @elseif ($transaction['network'] == 'DSTV')
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/240795f7-9799-1b1f-e877-d26c3870a81d.png">
                             @elseif ($transaction['network'] == 'GOTV')
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/9deb6d01-460f-4a2f-ac5b-e7c186358622.png">
                             @elseif ($transaction['network'] == 'STARTIME')
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/166284d4-5cfe-438c-b4a5-fc8d241d7aee.jpg">
                             @elseif ($transaction['network'] == 'SHOWMAX')
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/b1e4022c-331d-b427-0306-9230275ca6d9.jpg">
                             @else
                             <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/ca118e83-b696-4f3b-8769-975b004454b6.png">
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
             @endforeach
         </div>

     </div>
     @else
     <h3 class="d-block fw-normal dark-text text-center mt-3">There is no transaction record for now</h3>
     @endif
     <section class="panel-space"></section>

 </section>