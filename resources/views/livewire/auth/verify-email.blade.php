<div>
    <form wire:submit.prevent='confirmEmail' class="auth-form">
        <div class="custom-container">
            <p class="text-danger" wire:offline>
                Whoops, your device has lost connection.
            </p>
            <div class="form-group">
                <label for="email" class="form-label">Email confirmation code</label>
                <div class="form-input">
                    <input type="number" id="email_otp" inputmode="numeric" placeholder="Enter email confirmation code" wire:model.lazy="email_otp" class="form-control" oninput="this.value = this.value.slice(0, 6);">
                </div>
            </div>
            @error('email_otp')
            <span class="text-danger">{{ $message }}</span>
            @enderror

            <button type="submit" wire:loading.attr="disabled" class="btn theme-btn w-100">
                <span wire:loading wire:target="confirmEmail">Confirming otp...</span>
                <span wire:loading.remove> Confirm Email</span>
            </button>
            <h4 class="signup">Don't have an account?<a wire:navigate.hover href="{{ route('register') }}"> Register</a></h4>
        </div>
    </form>


</div>