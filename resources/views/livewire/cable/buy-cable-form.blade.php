<div>
    <div class="modal-body">

        @if ($beneficiaries)
        <div class="d-flex justify-content-between mb-1">
            <h3>Beneficiaries</h3>
            <a href="{{route('user.beneficiary')}}" class="theme-color">See all</a>
        </div>

        <div class="quick-send mb-2 border-b-2">
            @foreach ($beneficiaries as $item)
            <div class="profile" wire:click="$set('package', '{{ $item['provider'] }}'); $set('smartCardNo', '{{ $item['smartCardNo'] }}')">
                <div @click.prevent="$wire.set('package', '{{ $item['provider'] }}'); $wire.set('smartCardNo', '{{ $item['smartCardNo'] }}')" class="d-flex justify-content-between align-items-center">
                    <img src="{{ asset('assets/images/networks/' . $item['provider'] . '.png') }}" class="img-fluid" style="height: 30px; width: 30px;" alt="{{ $item['provider'] }}">
                    <h6 class="mb-0"> {{ ucfirst($item['beneficiary_name']) }}</h6>
            </div>
            <h6 class="light-text mb-0">{{ substr($item['smartCardNo'], -10) }}</h6>
        </div>
        @endforeach
    </div>

    @else
    <p>No beneficiaries found.</p>
    @endif

    <form class="auth-form p-0 mt-2" style="border-top: 2px solid #650A88;">

        <div class="form-group">
            <div class="row">
                @foreach (collect($types)->chunk(5) as $typeChunk) <!-- Convert to collection and chunk it -->
                <div class="d-flex justify-content-between text-center gap-2 mb-2" style="flex-wrap: wrap;">
                    @foreach ($typeChunk as $type)
                    @php
                    $typeLogo = match($type['name']) {
                    'SHOWMAX' => 'assets/images/networks/SHOWMAX.jpg',
                    'DSTV' => 'assets/images/networks/DSTV.png',
                    'GOTV' => 'assets/images/networks/GOTV.png',
                    'STARTIMES' => 'assets/images/networks/STARTIMES.jpg',
                    default => 'assets/images/networks/Vpay.png',
                    };
                    @endphp

                    <div class="network-item" style="flex: 1 0 calc(20% - 10px);">
                        <img src="{{ asset($typeLogo) }}" style="height: 25px; width: 25px;" alt="{{ $type['name'] }}" class="network-img rounded {{ $selectedType === $type['name'] ? 'selected' : '' }}" wire:click="$set('selectedType', '{{ $type['name'] }}')" />
                        <p class="text-light theme-color" style="font-size: xx-small;">{{ $type['name'] }}</p>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>

            <input type="hidden" wire:model="selectedType" class="form-control" />
        </div>


        @error('selectedType')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        @if ($packages)
        <div class="form-group">
            <label for="bundle" class="form-label">Select package</label>
            <select id="bundle" class="form-select" wire:model.live="selectedPackage">
                <option value="">Select</option>
                @foreach ($packages as $bundle)
                <option value="{{ $bundle['code'] . '/' . $bundle['name'] . '/' . $bundle['type'] . '/' . $bundle['reseller_price'] . '/' . $bundle['month'] }}">
                    {{ $bundle['name'] }}
                </option>
                @endforeach
            </select>
        </div>

        @error('selectedPackage')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label for="amount" class="form-label">Amount</label>
            <input readonly class="form-control" inputmode="number" wire:model="resellerPrice" />
        </div>
        @endif

        @if($selectedType && $selectedType !== 'SHOWMAX')
        <div class="form-group mt-2">
            <label for="smartCardNo" class="form-label">IUC/SmartCard Number</label>
            <input class="form-control" inputmode="number" wire:model.live="smartCardNo" placeholder="Enter your IUC or smartcard no" />
        </div>
        @error('smartCardNo')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        @if($customerName)
        <span class="text-success" style="font-size: small;"><b>{{ $customerName }}</b></span>
        @endif
        @endif


        @if ($disableButton != true)

        <div class="form-group" x-data="{ saveBeneficiary: false }">
            <div class="d-flex justify-content-between">
                <label for="inputPhone" class="form-label">Phone number</label>
                <a href="#" @click.prevent="$wire.set('phone', '{{ $userPhone }}'); $refs.phoneInput.value = '{{ $userPhone }}'" class="form-label theme-color">My number</a>
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

        <button type="button" wire:click="buyCableSubscription" wire:loading.attr="disabled" class="btn theme-btn w-100">
            <span wire:loading wire:target="buyCableSubscription">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Buying...
            </span>
            <span wire:loading.remove>
                Buy {{ $resellerPrice }} package
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