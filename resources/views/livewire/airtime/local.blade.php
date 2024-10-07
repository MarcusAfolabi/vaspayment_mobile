<div>
    <section class="section-b-space">
        <div class="custom-container">

            <ul class="nav nav-tabs custom-selectjs tab-style1" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="bank-tab" data-bs-toggle="tab" data-bs-target="#bank" type="button" role="tab">Bank</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab">Contact</button>
                </li>
            </ul>

            <div class="tab-content tab w-100" id="pills-tabContent1">
                <div class="tab-pane fade show active" id="bank" role="tabpanel" tabindex="0">

                    <div class="title mt-3">
                        <h2>Select a bank</h2>
                    </div>
                    <ul>
                        <li>
                            <div class="balance-content">
                                <h5>09035155129</h5>
                            </div>
                        </li>
                    </ul>
                    <div class="title mt-3">
                        <h2>Select Network</h2>
                    </div>
                    <form class="auth-form p-0" target="_blank">
                        <div class="form-group">
                            <select id="inputbankname" class="form-select">
                                <option disabled>Select network</option>
                                @foreach ($networks as $net)
                                <option value="{{ $net }}">{{ $net }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="amount">Recharge self</div>
                            <label for="inputamount" class="form-label">Amount</label>
                            <input type="text" class="form-control" id="inputamount" />
                        </div>
                        <a href="#error" class="btn theme-btn w-100" data-bs-toggle="modal">Transfer</a>
                    </form>
                </div>

                <div class="tab-pane fade" id="contact" role="tabpanel">
                    <div class="quick-send person-pay mt-3">
                        <h3>Recent payees</h3>

                        <div class="profile">
                            <a href="scan-pay.html" class="profile new-profile">
                                <div class="new-image">
                                    <i class="icon" data-feather="plus"></i>
                                </div>
                            </a>
                        </div>

                        <div class="profile">
                            <a href="person-transaction.html">
                                <img class="img-fluid person-img" src="assets/images/person/p1.png" alt="p1" />
                            </a>
                            <h5>Mike</h5>
                            <h6>**** 67</h6>

                        </div>

                        <div class="profile">
                            <a href="person-transaction.html">
                                <img class="img-fluid person-img" src="assets/images/person/p2.png" alt="p2" />
                                <h5>Michael</h5>
                                <h6>**** 72</h6>
                            </a>
                        </div>

                        <div class="profile">
                            <a href="person-transaction.html">
                                <img class="img-fluid person-img" src="assets/images/person/p3.png" alt="p3" />
                                <h5>Kristin</h5>
                                <h6>**** 32</h6>
                            </a>
                        </div>

                        <div class="profile">
                            <a href="person-transaction.html">
                                <img class="img-fluid person-img" src="assets/images/person/p4.png" alt="p4" />
                                <h5>Trunk</h5>
                                <h6>**** 45</h6>
                            </a>
                        </div>

                        <div class="profile">
                            <a href="person-transaction.html">
                                <img class="img-fluid person-img" src="assets/images/person/p5.png" alt="p5" />
                                <h5>Johnny</h5>
                                <h6>**** 56</h6>
                            </a>
                        </div>
                    </div>

                    <div class="title mt-3">
                        <h2>Transfer money to</h2>
                    </div>
                    <form class="auth-form p-0" target="_blank">
                        <div class="form-group">
                            <label for="inputbank" class="form-label">Bank name</label>
                            <select id="inputbank" class="form-select">
                                <option selected>Select bank</option>
                                <option>HDFC Bank</option>
                                <option>State Bank of India</option>
                                <option>bank of baroda</option>
                                <option>ICICI Bank</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputcard" class="form-label">Card number</label>
                            <div class="form-input">
                                <input type="number" class="form-control" id="inputcard" placeholder="Add card number" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputamount1" class="form-label">Amount</label>
                            <input type="text" class="form-control" id="inputamount1" />
                        </div>

                        <ul class="amount-list">
                            <li>
                                <div class="amount">$50</div>
                            </li>
                            <li>
                                <div class="amount">$100</div>
                            </li>
                            <li>
                                <div class="amount">$200</div>
                            </li>
                        </ul>
                        <a href="#error" class="btn theme-btn w-100" data-bs-toggle="modal">Transfer</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>