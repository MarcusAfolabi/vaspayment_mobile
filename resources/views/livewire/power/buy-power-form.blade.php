<div>
    <div class="modal-body">

        @if ($beneficiaries)
        <div class="d-flex justify-content-between mb-1">
            <h3>Beneficiaries</h3>
            <a href="{{route('user.beneficiary')}}" class="theme-color">See all</a>
        </div>

        <div class="quick-send mb-2 border-b-2">
            @foreach ($beneficiaries as $item)
            <div class="profile" wire:click="$set('meterno', '{{ $item['meterNo'] }}'); $set('provider', '{{ $item['provider'] }}'); $set('phone', '{{ $item['meterNo'] }}');">
                <div @click.prevent="$wire.set('phone', '{{ $item['phone'] }}'); $wire.set('provider', '{{ $item['provider'] }}'); $set('meterno', '{{ $item['meterNo'] }}');" class="d-flex justify-content-between align-items-center">
                    <img src="{{ asset('assets/images/networks/' . $item['provider'] . '.jpg') }}" class="img-fluid" style="height: 30px; width: 30px;" alt="{{ $item['provider'] }}">
                    <h6 class="mb-0"> {{ ucfirst($item['beneficiary_name']) }}</h6>
                </div>
                <h6 class="light-text mb-0">{{ substr($item['meterNo'], -10) }}</h6>
            </div>
            @endforeach
        </div>

        @else
        <p>No beneficiaries found.</p>
        @endif

        <form class="auth-form p-0 mt-2" style="border-top: 2px solid #650A88;">

            <div class="form-group">
                <div class="row">
                    @foreach (collect($networks)->chunk(5) as $networkChunk)
                    <div class="d-flex justify-content-between text-center gap-2 mb-2" style="flex-wrap: wrap;">
                        @foreach ($networkChunk as $plan)
                        @php
                        $networkLogo = '';
                        switch (true) {
                        case $plan['provider'] === 'AEDC':
                        $networkLogo = 'assets/images/networks/AEDC.jpg';
                        break;
                        case $plan['provider'] === 'EEDC':
                        $networkLogo = 'assets/images/networks/EEDC.jpg';
                        break;
                        case $plan['provider'] === 'EKEDC':
                        $networkLogo = 'assets/images/networks/EKEDC.jpg';
                        break;
                        case $plan['provider'] === 'IBEDC':
                        $networkLogo = 'assets/images/networks/IBEDC.jpg';
                        break;
                        case $plan['provider'] === 'IKEDC':
                        $networkLogo = 'assets/images/networks/IKEDC.jpg';
                        break;
                        case $plan['provider'] === 'JEDC':
                        $networkLogo = 'assets/images/networks/JEDC.jpg';
                        break;
                        case $plan['provider'] === 'KAEDC':
                        $networkLogo = 'assets/images/networks/KAEDC.jpg';
                        break;
                        case $plan['provider'] === 'KEDC':
                        $networkLogo = 'assets/images/networks/KEDC.jpg';
                        break;
                        case $plan['provider'] === 'PHEDC':
                        $networkLogo = 'assets/images/networks/PHEDC.jpg';
                        break;
                        default:
                        $networkLogo = 'assets/images/networks/Vpay.png'; // A fallback default logo
                        break;
                        }
                        @endphp

                        <div class="network-item" style="flex: 1 0 calc(20% - 10px);"> <!-- Each item takes up 20% width, with small margin -->
                            <img src="{{ asset($networkLogo) }}" style="height: 25px; width: 25px;" alt="{{ $plan['provider'] }}" class="network-img rounded {{ ($provider === $plan['provider'] || $selectedNetwork === $plan['provider']) ? 'selected' : '' }}" wire:click="$set('selectedNetwork', '{{ $plan['provider'] }}')" />


                            <p class="text-light theme-color" style="font-size: xx-small;">{{ $plan['provider'] }}</p>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>

                <input type="hidden" wire:model="selectedNetwork" class="form-control" />
            </div>
            @error('selectedNetwork')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            @if ($selectedNetwork || $provider )
            <div class="form-group">
                <label for="inputbankname" class="form-label">Meter Type</label>
                <select id="inputbankname" class="form-select" wire:model.live="selectedType">
                    <option value="">Select</option>
                    <option value="Prepaid"> PREPAID</option>
                    <option value="Postpaid"> POSTPAID</option>
                </select>
            </div>
            @error('selectedType')
            <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="form-group">
                <label for="meterno" class="form-label">Meter No</label>
                <input x-ref="meterno" type="number" class="form-control" wire:model.live="meterno"/>
            </div>

            @if($beneficiary)
            <span class="text-success" style="font-size: small;"><b>{{ $beneficiary }}</b>.</span>
            @endif

            @if($minimumPayable)
            <span class="text-success" style="font-size: small;">Minimum payable is <b>₦{{ $minimumPayable }}</b></span>
            @endif

            @error('meterno')
            <span class="text-danger" style="font-size: small;">{{ $message }}</span>
            @enderror

            <div class="form-group">
                <label for="inputamount1" class="form-label">Amount</label>
                <input type="tel" maxlength="4" class="form-control" inputmode="number" placeholder="{{ $minimumPayable }}" wire:model="amount" />
            </div>
            @endif


            @if ($disableButton != true)
            <div class="form-group" x-data="{ saveBeneficiary: false }">
                <div class="d-flex justify-content-between">
                    <label for="inputPhone" class="form-label">Phone number</label>
                    <a href="#" @click.prevent="$wire.set('phone', '{{ $userPhone }}'); $refs.phoneInput.value = '{{ $userPhone }}'" class="form-label theme-color">Self Recharge</a>
                </div>
                <input type="tel" autocomplete="tel" maxlength="11" inputmode="number" wire:model="phone" x-ref="phoneInput" class="form-control" id="inputPhone" placeholder="Enter phone number" /> 
                @error('phone')<span class="text-danger">{{ $message }}</span> @enderror 
                <!-- Save Beneficiary Checkbox -->
                <div class="mt-3">
                    <input type="checkbox" id="saveBeneficiary" wire:model="saveBeneficiary" x-model="saveBeneficiary" />
                    <label for="saveBeneficiary">Save beneficiary</label>
                </div>

                <div class="mt-3" x-show="saveBeneficiary" x-cloak>
                    <input type="text" autocomplete="name" class="form-control" maxlength="6" id="beneficiaryName" wire:model="beneficiaryName" placeholder="Beneficiary Name (Optional)" />
                </div>

            </div>

            <button type="button" wire:click="BuyToken" wire:loading.attr="disabled" class="btn theme-btn w-100">
                <span wire:loading wire:target="BuyToken">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Buying...
                </span>
                <span wire:loading.remove>
                    Buy {{ $amount }} Data
                </span>
            </button>
            @if($errorMessage)
            <div class="alert alert-danger">{{ $errorMessage }}</div>
            @endif
            @endif
        </form>
        
        <style>
            .network-img {
                cursor: pointer;
                transition: border 0.3s, background-color 0.3s;
            }

            .network-img:hover {
                background-color: #f0f0f0;
            }

            .network-img.selected {
                border: 2px solid #650A88;
            }

            .amount {
                cursor: pointer;
                padding: 10px;
                border: 1px solid transparent;
                transition: background-color 0.3s, border 0.3s;
            }

            .amount:hover {
                background-color: #f0f0f0;
            }

            .amount.selected {
                border: 2px solid #650A88;
            }
        </style>
    </div>
</div>