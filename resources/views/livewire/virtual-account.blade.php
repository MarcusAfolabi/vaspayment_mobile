<div>
    @if ($accounts)
    @foreach ($accounts as $name => $accountNo)
    <section>
        <div class="custom-container">
            <div class="crypto-wallet-box">
                <div class="card-details">
                    <div class="d-block w-75">
                        <h5 class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $name)) }}</h5>
                        <h2 class="mt-2">{{ $accountNo }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    @endif
    @if ($submit_nin)
   You do not have NIN/BVN
    @endif


    {{-- <section>
    <div class="custom-container">
      <div class="crypto-wallet-box">
        <div class="card-details">
          <div class="d-block w-75">
            <h5 class="fw-semibold">Wema account</h5>
            <h2 class="mt-2">091209121</h2>
          </div>
          <div class="price-difference">
            <i class="menu-icon" data-feather="arrow-up"></i>
            <h6>3% Fee </h6>
          </div>
        </div>
      </div>
    </div>
  </section> --}}


</div>