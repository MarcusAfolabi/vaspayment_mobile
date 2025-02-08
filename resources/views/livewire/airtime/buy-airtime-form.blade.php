<div>
    <div class="modal-body">

        @if ($beneficiaries)
        <div class="d-flex justify-content-between mb-1">
            <h3>Beneficiaries</h3>
            <a href="{{route('user.beneficiary')}}" class="theme-color">See all</a>
        </div>

        <div class="quick-send mb-2 border-b-2">
            @foreach ($beneficiaries as $item)
            <div class="profile" wire:click="$set('phone', '{{ $item['phone'] }}'); $set('network', '{{ $item['provider'] }}')">
                <div @click.prevent="$wire.set('phone', '{{ $item['phone'] }}'); $wire.set('network', '{{ $item['provider'] }}')" class="d-flex justify-content-between align-items-center">
                    <img src="{{ asset('assets/images/networks/' . strtolower($item['provider']) . '.png') }}" class="img-fluid" style="height: 30px; width: 30px;" alt="{{ $item['provider'] }}">
                    <h6 class="mb-0"> {{ ucfirst($item['beneficiary_name']) }}</h6> <!-- No margin below the heading -->
                </div>
                <h6 class="light-text mb-0">{{ substr($item['phone'], -10) }}</h6> <!-- No margin below the heading -->
            </div>
            @endforeach
        </div>

        @else
        <p>No beneficiaries found.</p>
        @endif

        <form class="auth-form p-0 mt-2" style="border-top: 2px solid #650A88;">
            <div class="form-group">
                <div class="d-flex justify-content-between align-items-center text-center gap-4" style="height: 10vh;">
                    <img src="{{ asset('assets/images/networks/mtn.png') }}" style="height: 40px; width: 40px;" alt="MTN" class="network-img rounded {{ $network === 'MTN' ? 'selected' : '' }}" wire:click="$set('network', 'MTN')" />
                    <img src="{{ asset('assets/images/networks/airtel.png') }}" style="height: 40px; width: 40px;" alt="AIRTEL" class="network-img rounded {{ $network === 'AIRTEL' ? 'selected' : '' }}" wire:click="$set('network', 'AIRTEL')" />
                    <img src="{{ asset('assets/images/networks/glo.png') }}" style="height: 40px; width: 40px;" alt="GLO" class="network-img rounded {{ $network === 'GLO' ? 'selected' : '' }}" wire:click="$set('network', 'GLO')" />
                    <img src="{{ asset('assets/images/networks/9mobile.png') }}" style="height: 40px; width: 40px;" alt="9MOBILE" class="network-img rounded {{ $network === '9MOBILE' ? 'selected' : '' }}" wire:click="$set('network', '9MOBILE')" />
                </div>
                <input type="hidden" wire:model="network" class="form-control" />
            </div>
            @error('network')<span class="text-danger">{{ $message }}</span> @enderror

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

            <div class="form-group">
                <label for="inputamount1" class="form-label">Amount</label>
                <input type="tel" maxlength="4" autocomplete="transaction-amount" class="form-control" inputmode="number" wire:model="amount" id="inputamount" placeholder="₦1000" />
            </div>

            <ul class="amount-list">
                <li>
                    <div class="amount {{ $amount == 100 ? 'selected' : '' }}" wire:click="$set('amount', 100)">₦100</div>
                </li>
                <li>
                    <div class="amount {{ $amount == 300 ? 'selected' : '' }}" wire:click="$set('amount', 300)">₦300</div>
                </li>
                <li>
                    <div class="amount {{ $amount == 500 ? 'selected' : '' }}" wire:click="$set('amount', 500)">₦500</div>
                </li>
                <li>
                    <div class="amount {{ $amount == 1000 ? 'selected' : '' }}" wire:click="$set('amount', 1000)">₦1000</div>
                </li>
            </ul>
            @error('amount')<span class="text-danger">{{ $message }}</span> @enderror

            <button type="button" wire:click="buyAirtime" wire:loading.attr="disabled" class="btn theme-btn w-100">
                <span wire:loading wire:target="buyAirtime">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Buying...
                </span>
                <span wire:loading.remove>
                    Buy {{ $amount }} Airtime
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