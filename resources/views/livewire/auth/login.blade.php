<div>
    <form wire:submit.prevent='login' class="auth-form">
        <div class="custom-container">
            <p class="text-danger" wire:offline>
                Whoops, your device has lost connection.
            </p>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="form-input">
                    <input wire:model.lazy='email' name='email' type="email" class="form-control"
                        placeholder="Enter Your Email" />
                </div>
            </div>
            @error('email')
                <em class="text-danger">{{ $message }}</em>
            @enderror

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="form-input">
                    <input wire:model.lazy='password' name='password' type="password" class="form-control"
                        placeholder="Enter Your password" />
                </div>
            </div>
            @error('password')
                <em class="text-danger">{{ $message }}</em>
            @enderror

            <div class="remember-option mt-3">
                <div class="form-check">
                    <input wire:model.lazy='remember_me' class="form-check-input" type="checkbox" value="1" />
                    <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                </div>
                <a wire:navigate.hover class="forgot" href="{{ route('forget.password') }}">Forgot password?</a>
            </div>

            <input hidden value="{{ $location_data }}" wire:model='location_data' />
            @error('location_data')
                <em class="text-danger">{{ $message }}</em>
            @enderror

            <input hidden value="{{ $device_data }}" wire:model="device_data">
            @error('device_data')
                <em class="text-danger">{{ $message }}</em>
            @enderror
             @error('error')
                <em class="text-danger">{{ $message }}</em>
            @enderror

            <button type="submit" wire:loading.attr="disabled" class="btn theme-btn w-100" >
                <span wire:loading wire:target="login">Checking records...</span>
                <span wire:loading.remove> Login</span>
            </button>
            <h4 class="signup">Don't have an account?<a wire:navigate.hover href="{{ route('register') }}"> Register</a></h4>
        </div>
    </form>


</div>
