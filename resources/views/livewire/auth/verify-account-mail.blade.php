<div>
    <form wire:submit.prevent='confirmEmail' class="auth-form">
        <div class="custom-container">
            <p class="text-danger" wire:offline>
                Whoops, your device has lost connection.
            </p>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="form-input">
                    <input type="email" placeholder="Enter your email" wire:model.lazy="email" class="form-control">
                </div>
            </div>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror

            <button type="submit" wire:loading.attr="disabled" class="btn theme-btn w-100">
                <span wire:loading wire:target="confirmEmail">Sending otp...</span>
                <span wire:loading.remove> Confirm Email</span>
            </button>
            <h4 class="signup">Don't have an account?<a wire:navigate.hover href="{{ route('register') }}"> Register</a></h4>
        </div>
    </form>


</div>