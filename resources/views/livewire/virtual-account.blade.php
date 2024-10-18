<div>
  @if($virtualAccount != []);
  @if ($virtualAccount['monipoint_no'])
  <section>
    <div class="custom-container">
      <div class="crypto-wallet-box">
        <div class="card-details" x-data="{ copied: false }">
          <div class="d-block w-75">
            <h5 class="fw-semibold">Moniepoint Microfinance Bank</h5>
            <h2 class="mt-2" x-ref="monipointAccount">{{ $virtualAccount['monipoint_no'] }}</h2>
          </div>
          <div class="price-difference">
            <i class="menu-icon" data-feather="arrow-up"></i>
            <span class="copy-btn" x-on:click="
                  navigator.clipboard.writeText($refs.monipointAccount.innerText).then(() => {
                    copied = true;
                    setTimeout(() => copied = false, 2000);
                  }).catch(() => {
                    copied = false;
                    alert('Failed to copy');
                  })" aria-label="Copy Moniepoint Account">
              <h6 x-text="copied ? 'Copied!' : 'Copy'"></h6>
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif

  @if ($virtualAccount['wema_no'])
  <section>
    <div class="custom-container">
      <div class="crypto-wallet-box">
        <div class="card-details" x-data="{ copied: false }">
          <div class="d-block w-75">
            <h5 class="fw-semibold">Wema Bank</h5>
            <h2 class="mt-2" x-ref="wemaAccount">{{ $virtualAccount['wema_no'] }}</h2>
          </div>
          <div class="price-difference">
            <i class="menu-icon" data-feather="arrow-up"></i>
            <span class="copy-btn" x-on:click="
              navigator.clipboard.writeText($refs.wemaAccount.innerText).then(() => {
                copied = true;
                setTimeout(() => copied = false, 2000);
              }).catch(() => {
                copied = false;
                alert('Failed to copy');
              })" aria-label="Copy Wema Account">
              <h6 x-text="copied ? 'Copied!' : 'Copy'"></h6>
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif

  @if ($virtualAccount['budpay_wema_no'])
  <section>
    <div class="custom-container">
      <div class="crypto-wallet-box">
        <div class="card-details" x-data="{ copied: false }">
          <div class="d-block w-75">
            <h5 class="fw-semibold">{{ $virtualAccount['budpay_reference'] }}</h5>
            <h2 class="mt-2" x-ref="wemaAccount">{{ $virtualAccount['budpay_wema_no'] }}</h2>
          </div>
          <div class="price-difference">
            <i class="menu-icon" data-feather="arrow-up"></i>
            <span class="copy-btn" x-on:click="
              navigator.clipboard.writeText($refs.wemaAccount.innerText).then(() => {
                copied = true;
                setTimeout(() => copied = false, 2000);
              }).catch(() => {
                copied = false;
                alert('Failed to copy');
              })" aria-label="Copy Wema Account">
              <h6 x-text="copied ? 'Copied!' : 'Copy'"></h6>
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif
  <br>
  @error('bvn')
  <div class="custom-container">
    <span class="text-success pt-4 text-center text-sm">{{ $message }}</span>
  </div>
  @enderror

  @endif

  @if ($create_virtual_account_form)
  <form wire:submit.prevent='verifyBVN' class="auth-form">
    <div class="custom-container">

      <div class="form-group">
        <label for="email" class="form-label">BVN</label>
        <div class="form-input">
          <input wire:model='bvn' type="tel" maxlength="11" class="form-control" placeholder="Enter your bvn" />
        </div>
      </div>
      @error('bvn')
      <span class="text-danger">{{ $message }}</span>
      @enderror

      <button type="submit" wire:loading.attr="disabled" class="btn theme-btn w-100">
        <span wire:loading wire:target="verifyBVN">Checking...</span>
        <span wire:loading.remove> Create Virtual Account</span>
      </button>
    </div>
  </form>
  <div class="division">
    <span>OR</span>
  </div>
  <form wire:submit.prevent='verifyNIN' class="auth-form">
    <div class="custom-container">
      <div class="form-group">
        <label for="nin" class="form-label">NIN</label>
        <div class="form-input">
          <input wire:model='nin' type="tel" maxlength="11" class="form-control" placeholder="Enter your NIN" />
        </div>
      </div>
      @error('nin')
      <span class="text-danger">{{ $message }}</span>
      @enderror

      <button type="submit" wire:loading.attr="disabled" class="btn theme-btn w-100">
        <span wire:loading wire:target="verifyNIN">Checking...</span>
        <span wire:loading.remove> Create Virtual Account</span>
      </button>
    </div>
  </form>
  @endif

  @if ($transactions)
  <div class="custom-container">

    <div class="title mt-4">
      <h2>Wallet History </h2>
      <a href="{{ route('all.transactions') }}">See more</a>
    </div>


    <div class="row gy-3">
      @foreach($transactions as $key => $transaction)
      @php

      $amountParts = explode('.', number_format($transaction['amount'], 2));
      $createdDate = \Carbon\Carbon::parse($transaction['created_at']);

      if ($createdDate->isToday()) {
      $formattedDate = 'Today ' . $createdDate->format('g:i a');
      } elseif ($createdDate->isYesterday()) {
      $formattedDate = 'Yesterday ' . $createdDate->format('g:i a');
      } else {
      $formattedDate = $createdDate->format('D d/m');
      }
      @endphp

      <div class="col-12">
        <div class="transaction-box">
          <a href="#" class="d-flex gap-3">
            <div class="transaction-image">
              <img style="width: 40px; height: 40px; vertical-align: middle; border-radius: 50%;" src="https://mcusercontent.com/bc4757f5630fae4685e6bed63/images/ca118e83-b696-4f3b-8769-975b004454b6.png">
            </div>

            <div class="transaction-details">
              <div class="transaction-name">
                <h5>{{ $transaction['type'] }} </h5>
                <h3 class="text-danger">
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
  <h3 class="d-block fw-normal dark-text text-center mt-3">There is no wallet transaction record for now</h3>
  @endif
  <section class="panel-space"></section>
</div>