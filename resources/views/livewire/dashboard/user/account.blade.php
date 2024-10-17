<div class="custom-container">

    <div class="profile-section">
        <div class="profile-banner">
            <div class="profile-image">
                <img class="img-fluid profile-pic" src="{{ $photo }}" alt="p3" />
            </div>
        </div>
        <h2>{{ $name }}</h2>
        <!-- <h5>Referral ID: {{ $referralId }} <img src="{{ asset('assets/feather/copy.svg') }}" /> </h5> -->
        <div x-data="{
        referralId: '{{ $referralId }}',
        copyToClipboard() {
            navigator.clipboard.writeText(this.referralId).then(() => {
                alert('Referral ID copied!');
            }).catch(err => {
                console.error('Could not copy text: ', err);
            });
        }
    }">
            <h5>
                Referral ID: {{ $referralId }}
                <img src="{{ asset('assets/feather/copy.svg') }}" @click="copyToClipboard()" style="cursor: pointer;" alt="Copy Referral ID" />
            </h5>
        </div>

    </div>
    <form class="auth-form pt-0 mt-3" target="_blank">
        <div class="form-group">
            <label for="firstname" class="form-label">First name</label>
            <input readonly class="form-control" wire:model="name" />
        </div>
        <div class="form-group">
            <label for="lastname" class="form-label">Last name</label>
            <input type="text" class="form-control" maxlength="20" placeholder="Enter your lastname" wire:model.blur="lastname" @if($lastname !==null) readonly @endif />
        </div>

        @error('lastname')
        <span class="text-success">{{ $message }}</span>
        @enderror


        <div class="form-group">
            <label for="email" class="form-label">Email address</label>
            <input readonly class="form-control" wire:model="email" />
        </div>
        <div class="form-group">
            <label for="phone" class="form-label">Phone number</label>
            <input readonly class="form-control" wire:model="phone" />
        </div>
    </form>

</div>