<div>
    @livewire('balance-card')
    <div class="modal add-money-modal fade" id="make-transfer" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Transfer Funds</h2>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="transfer" x-data="{ from: '', to: '' }">
                        <div class="form-group">
                            <label for="inputcard" class="form-label mb-2">From</label>
                            <div class="d-flex gap-2">
                                <select id="fromSelect" wire:model="from" x-model="from" class="form-select">
                                    <option selected hidden>Select</option>
                                    <option value="{{$commission}}/commission">₦{{ $commission }} - Commission</option>
                                    <option value="{{$bonus}}/bonus">₦{{ $bonus }} - Bonus</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputamount" class="form-label mb-2">Amount</label>
                            <div class="form-input">
                                <input type="number" wire:model="inputAmount" class="form-control" id="inputamount" placeholder="Enter amount" />
                            </div>
                        </div> 
                        
                        <button class="btn theme-btn successfully w-100" type="submit">Transfer</button>
                    </form>

                </div>

                <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                    <img src="{{ asset('assets/feather/x.svg') }}" />
                </button>
            </div>
        </div>
    </div>
</div>