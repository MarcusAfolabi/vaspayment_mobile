<div>
    <form wire:submit.prevent='login' class="auth-form">
        <div class="custom-container">
            <p class="text-danger" wire:offline>
                Whoops, your device has lost connection.
            </p>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="form-input">
                    <input wire:model.lazy='email' name='email' type="email" class="form-control" placeholder="Enter your email" />
                </div>
            </div>
            @error('email')
            <em class="text-danger">{{ $message }}</em>
            @enderror

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="form-input" style="position: relative;" x-data="{ show: false }">
                    <input :type="show ? 'text' : 'password'" wire:model="password" name="password" class="form-control" placeholder="Enter your password" style="padding-right: 45px;" />

                    <!-- Toggle Button -->
                    <button type="button" @click="show = !show" class="toggle-password-btn">
                        <span x-text="show ? 'Hide' : 'Show'"></span>
                    </button>
                </div>
            </div>
            <style>
                /* Styling for the toggle button */
                .toggle-password-btn {
                    position: absolute;
                    right: 10px;
                    top: 50%;
                    transform: translateY(-50%);
                    background: none;
                    border: none;
                    cursor: pointer;
                    font-size: 0.875rem;
                    color: #007bff;
                    padding: 0;
                }

                /* Optional: Hover effect */
                .toggle-password-btn:hover {
                    color: #0056b3;
                }

                /* Adjust input padding for the toggle button */
                .form-control {
                    padding-right: 45px;
                    /* Ensures space for the button inside the input field */
                }
            </style>

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


            <button type="submit" wire:loading.attr="disabled" class="btn theme-btn w-100">
                <span wire:loading wire:target="login">Checking records...</span>
                <span wire:loading.remove> Login</span>
            </button>
            <h6 class="signup">Email verification? <a wire:navigate.hover class="signup" href="{{ route('verify.email.account') }}">Verify now</a></h6>
                <h4 class="signup">Don't have an account?<a wire:navigate.hover href="{{ route('register') }}"> Register</a></h4>
        </div>
    </form>
</div>