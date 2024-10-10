<div>
  @if ($accounts)
  <section>
    <div class="custom-container">
      <div class="crypto-wallet-box">
        <!-- Moniepoint Microfinance Bank -->
        <div class="card-details" x-data="{ copied: false }">
          <div class="d-block w-75">
            <h5 class="fw-semibold">Moniepoint Microfinance Bank</h5>
            <h2 class="mt-2" x-ref="monipointAccount">{{ $accounts['monipoint_no'] }}</h2>
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

  <section>
    <div class="custom-container">
      <div class="crypto-wallet-box">
        <!-- Wema Bank -->
        <div class="card-details" x-data="{ copied: false }">
          <div class="d-block w-75">
            <h5 class="fw-semibold">Wema Bank</h5>
            <h2 class="mt-2" x-ref="wemaAccount">{{ $accounts['wema_no'] }}</h2>
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





  @if ($submit_nin)

  <form wire:submit.prevent='verifyBVN' class="auth-form">
    <div class="custom-container">

      <div class="form-group">
        <label for="email" class="form-label">BVN</label>
        <div class="form-input">
          <input wire:model='bvn' type="tel" maxlength="11" class="form-control" placeholder="Enter your bvn" />
        </div>
      </div>
      @error('bvn')
      <em class="text-danger">{{ $message }}</em>
      @enderror

      <button type="submit" wire:loading.attr="disabled" class="btn theme-btn w-100">
        <span wire:loading wire:target="verifyBVN">Checking...</span>
        <span wire:loading.remove> Confirm</span>
      </button>
    </div>
  </form>
  @endif


</div>