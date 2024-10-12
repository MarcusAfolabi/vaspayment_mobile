<div>
    <div class="modal-body">


        <div class="quick-send person-pay mt-3">
            <h3>Recent beneficiaries</h3>

            <div class="profile">
                <a href="#">
                    <img class="img-fluid person-img" src="{{ asset('assets/images/person/p1.png') }}" alt="p1" />
                </a>
                <h6>Mike</h6>
                <h6>**** 67</h6>

            </div>
        </div>


        <form class="auth-form p-0">
            <div class="form-group">
                <label for="inputbank" class="form-label">Network name</label>
                <div class="d-flex justify-content-between align-items-center text-center gap-4" style="height: 10vh;">
                    <img src="{{ asset('assets/images/networks/mtn.png') }}" style="height: 30px; width: 30px;" />
                    <img src="{{ asset('assets/images/networks/airtel.png') }}" style="height: 30px; width: 30px;" />
                    <img src="{{ asset('assets/images/networks/glo.png') }}" style="height: 30px; width: 30px;" />
                    <img src="{{ asset('assets/images/networks/9mobile.png') }}" style="height: 30px; width: 30px;" />
                </div>
            </div>

            <div class="form-group">
                <div x-data="{ saveBeneficiary: false, phone: '' }">
                    <div class="d-flex justify-content-between">
                        <label for="inputPhone" class="form-label">Phone number</label>
                        <!-- 'Self Recharge' click action -->
                        <a href="#" @click.prevent="phone = '{{ $userPhone }}'" class="form-label text-success">Self Recharge</a>
                    </div>

                    <!-- Phone Number Input (empty by default, populated when clicking "Self Recharge") -->
                    <input type="number" class="form-control" id="inputPhone" x-model="phone" placeholder="Enter phone number" />

                    <!-- Save Beneficiary Checkbox -->
                    <div class="mt-3">
                        <input type="checkbox" id="saveBeneficiary" x-model="saveBeneficiary" />
                        <label for="saveBeneficiary">Save beneficiary</label>
                    </div>

                    <!-- Beneficiary Name Input (Optional) -->
                    <div class="mt-3" x-show="saveBeneficiary" x-cloak>
                        <input type="text" class="form-control" id="beneficiaryName" name="beneficiaryName" placeholder="Beneficiary Name (Optional)" />
                    </div>
                </div>




                <div class="form-group">
                    <label for="inputamount1" class="form-label">Amount</label>
                    <input type="text" class="form-control" id="inputamount1" />
                </div>

                <ul class="amount-list">
                    <li>
                        <div class="amount">$100</div>
                    </li>
                    <li>
                        <div class="amount">$300</div>
                    </li>
                    <li>
                        <div class="amount">$500</div>
                    </li>
                    <li>
                        <div class="amount">$1000</div>
                    </li>
                </ul>
                <button type="button" wire:click="BuyAirtime" class="btn theme-btn successfully w-100">Buy {{$amount}} Airtime</button>
        </form>

        @error('response') <span class="text-danger" style="font-size: 12px;">{{ $message }}</span> @enderror
    </div>


</div>