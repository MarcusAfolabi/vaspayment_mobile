<div>
    <form wire:submit.prevent='forget' class="auth-form">
        <div class="custom-container">
            <p class="text-danger" wire:offline>
                Whoops, your device has lost connection.
            </p>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="form-input">
                    <input wire:model.lazy='email' readonly name='email' type="email" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Password</label>
                <div class="form-input">
                    <input wire:model.lazy='email' type="password" class="form-control"
                        placeholder="Enter your new password" />
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Confirm password</label>
                <div class="form-input">
                    <input wire:model.lazy='email' type="password" class="form-control"
                        placeholder="Enter again to confirm" />
                </div>
            </div>
            @error('email')
                <em class="text-danger">{{ $message }}</em>
            @enderror
            <div class="remember-option mt-3">
                <div hidden class="form-check">
                    <input wire:model.lazy='remember_me' class="form-check-input" type="checkbox" value="yes" />
                    <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                </div>
            </div>

            <button type="submit" wire:loading.attr="disabled" class="btn theme-btn w-100" >
                <span wire:loading wire:target="forget">Sending mail...</span>
                <span wire:loading.remove> Send Reset Link</span>
            </button>
            <h4 class="signup">Don't have an account?<a wire:navigate.hover href="{{ route('register') }}"> Register</a></h4>
        </div>
    </form>


</div>
