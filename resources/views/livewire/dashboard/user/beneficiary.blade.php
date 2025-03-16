<section class="section-b-space">
    <div class="custom-container">
        <ul class="bill-pay-list">
            @foreach ($beneficaries as $ben)
            @if (!empty($ben['list']) && is_array($ben['list']))
            @foreach ($ben['list'] as $item)
            <li class="w-100 border border-light bg-white rounded-3 mb-2 mt-2 p-2 shadow-sm transition"
                onmouseover="this.classList.add('shadow-lg', 'bg-light')"
                onmouseout="this.classList.remove('shadow-lg', 'bg-light')">
           
            <div class="bill-pay-box">
                <div class="bill-pay-img">
                    <img src="{{ asset('assets/feather/tablet.svg') }}" />
                </div>
                <div class="bill-pay-details">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <a href="#">
                            <h5 class="fw-normal dark-text">{{ $item['provider'] ?? '' }} {{ ucfirst($item['network'] ?? '') }}</h5>
                        </a>
                        <h3 class="theme-color">
                            <img src="{{ asset('assets/feather/trash-2.svg') }}" wire:click="delete('{{ $item['uuid'] }}', '{{ $item['type'] }}')" wire:confirm="Are you sure you want to delete this beneficiary?" style="width: 18px; height: 18px; cursor: pointer;" />
                        </h3>

                    </div>
                    <div class="d-flex justify-content-between align-items-center w-100 mt-1">
                        <h6 class="fw-normal light-text">{{ $item['beneficiary_name'] ?? '' }}</h6>
                        <h5 class="fw-normal light-text">
                            @if ($item['type'] == 'airtime' || $item['type'] == 'data')
                            {{ $item['phone'] ?? '' }}
                            @endif

                            {{ $item['meterNo'] ?? '' }} {{ $item['smartCardNo'] ?? '' }}
                        </h5>
                    </div>
                </div>
            </div>
            </li>
            @endforeach
            @endif
            @endforeach
        </ul>
    </div>
</section>