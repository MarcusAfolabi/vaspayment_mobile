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
        <section class="section-b-space">
            <div class="custom-container">
                <ul class="nav nav-tabs custom-selectjs tab-style1" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="bank-tab" data-bs-toggle="tab" data-bs-target="#bank"
                            type="button" role="tab">NIN</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab">BVN</button>
                    </li>
                </ul>

                <div class="tab-content tab w-100" id="pills-tabContent1">
                    <div class="tab-pane fade show active" id="bank" role="tabpanel" tabindex="0">
                        <div class="title mt-3">
                            <h2>Create virtual account using</h2>
                        </div>
                        <form class="auth-form p-0" target="_blank">
                            <div class="form-group">
                                <label for="inputcard" class="form-label">NIN number</label>
                                <div class="form-input">
                                    <input type="number" max='11' class="form-control" id="inputcard"
                                        placeholder="Enter nin number" />
                                </div>
                            </div>
                            <button class="btn theme-btn w-100" data-bs-toggle="modal">Create</button>
                    </div>

                    <div class="tab-pane fade" id="contact" role="tabpanel">
                        <div class="title mt-3">
                            <h2>Create virtual account using</h2>
                        </div>
                        <form class="auth-form p-0" target="_blank">
                            <div class="form-group">
                                <label for="inputcard" class="form-label">BVN number</label>
                                <div class="form-input">
                                    <input type="number" max='11' class="form-control" id="inputcard"
                                        placeholder="Enter bvn number" />
                                </div>
                            </div>
                            <button class="btn theme-btn w-100" data-bs-toggle="modal">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
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
