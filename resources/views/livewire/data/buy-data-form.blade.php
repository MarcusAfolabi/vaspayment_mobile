<div>
    <div class="modal-body">

        @if ($beneficiaries)
        <div class="d-flex justify-content-between mb-1">
            <h3>Beneficiaries</h3>
            <a href="#" class="theme-color">See all</a>
        </div>

        <div class="quick-send mb-2 border-b-2">
            @foreach ($beneficiaries as $item)
            <div class="profile" wire:click="$set('phone', '{{ $item['phone'] }}'); $set('network', '{{ $item['provider'] }}')">
                <div @click.prevent="$wire.set('phone', '{{ $item['phone'] }}'); $wire.set('network', '{{ $item['provider'] }}')" class="d-flex justify-content-between align-items-center">
                    <img src="{{ asset('assets/images/networks/' . strtolower($item['provider']) . '.png') }}" class="img-fluid" style="height: 30px; width: 30px;" alt="{{ $item['provider'] }}">
                    <h6 class="mb-0"> {{ ucfirst($item['beneficiary_name']) }}</h6>
                </div>
                <h6 class="light-text mb-0">{{ substr($item['phone'], -10) }}</h6>
            </div>
            @endforeach
        </div>

        @else
        <p>No beneficiaries found.</p>
        @endif

        <form class="auth-form p-0 mt-2" style="border-top: 2px solid #650A88;">

            <div class="form-group">
                <div class="row">
                    @foreach (collect($networks)->chunk(5) as $networkChunk) <!-- Convert to collection and chunk it -->
                    <div class="d-flex justify-content-between text-center gap-2 mb-2" style="flex-wrap: wrap;">
                        @foreach ($networkChunk as $plan)
                        @php
                        $networkLogo = '';
                        switch (true) {
                        case $plan['network'] === 'MTN' || $plan['name'] === 'MTN':
                        $networkLogo = 'assets/images/networks/mtn.png';
                        break;

                        case $plan['network'] === 'AIRTEL' || $plan['name'] === 'AIRTEL':
                        $networkLogo = 'assets/images/networks/airtel.png';
                        break;

                        case $plan['network'] === 'GLO' || $plan['name'] === 'GLO':
                        $networkLogo = 'assets/images/networks/glo.png';
                        break;

                        case $plan['network'] === '9MOBILE' || $plan['name'] === '9MOBILE':
                        $networkLogo = 'assets/images/networks/9mobile.png';
                        break;

                        default:
                        $networkLogo = 'assets/images/networks/default.png'; // A fallback default logo
                        break;
                        }
                        @endphp

                        <div class="network-item" style="flex: 1 0 calc(20% - 10px);"> 
                            <img src="{{ asset($networkLogo) }}" style="height: 25px; width: 25px;" alt="{{ $plan['network'] }}" class="network-img rounded {{ ($selectedNetwork === $plan['network'] || $network === $plan['network']) ? 'selected' : '' }}" wire:click="$set('selectedNetwork', '{{ $plan['name'] }}/{{ $plan['network'] }}')" />

                            <p class="text-light theme-color" style="font-size: xx-small;">{{ $plan['name'] }}</p>
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
            <!-- Display the names of the bundles after selecting a network -->
            @if ($selectedNetwork)
            <div class="form-group">
                <label for="inputbankname" class="form-label">Select bundle</label>
                <select id="inputbankname" class="form-select" wire:model.live="selectedBundle">
                    <option value="">Select</option>
                    @foreach ($bundles as $bundle)
                    <option value="{{ $bundle['code'] . '/' . $bundle['name'] . '/' . $bundle['network'] . '/' . $bundle['reseller_price'] . '/' . $bundle['allowance'] . '/' . $bundle['validity'] }}">
                        {{ $bundle['name'] }} | {{ $bundle['allowance'] }} | {{ $bundle['validity'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            @error('selectedBundle')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label for="inputamount1" class="form-label">Amount</label>
                <input readonly class="form-control" inputmode="number" wire:model="resellerPrice" />
            </div>
            @endif
            



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

            <button type="button" wire:click="buyDataBundle" wire:loading.attr="disabled" class="btn theme-btn w-100">
                <span wire:loading wire:target="buyDataBundle">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Buying...
                </span>
                <span wire:loading.remove>
                    Buy {{ $resellerPrice }} Data
                </span>
            </button>
            @if($errorMessage)
            <div class="alert alert-danger">{{ $errorMessage }}</div>
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