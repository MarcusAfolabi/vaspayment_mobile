<div>
    <form wire:submit.prevent='resetPassword' class="auth-form">
        <div class="custom-container">
            <p class="text-danger" wire:offline>
                Whoops, your device has lost connection.
            </p>
            <div class="form-group">
                <label for="email" class="form-label">Email confirmation code</label>
                <div class="form-input">
                    <input type="number" id="email_code" inputmode="numeric" placeholder="Enter email confirmation code" wire:model.lazy="email_code" class="form-control" oninput="this.value = this.value.slice(0, 6);">
                </div>
            </div>
            @error('email_code')
            <em class="text-danger">{{ $message }}</em>
            @enderror

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="form-input" style="position: relative;" x-data="{ show: false }">
                    <input :type="show ? 'text' : 'password'" wire:model="password" name="password" class="form-control" placeholder="Enter your preferred password" style="padding-right: 45px;" />

                    <!-- Toggle Button -->
                    <button type="button" @click="show = !show" class="toggle-password-btn">
                        <span x-text="show ? 'Hide' : 'Show'"></span>
                    </button>
                </div>
            </div>
            <style>
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

                .toggle-password-btn:hover {
                    color: #0056b3;
                }

                .form-control {
                    padding-right: 45px;
                }
            </style>

            @error('password')
            <em class="text-danger">{{ $message }}</em>
            @enderror

            <button type="submit" wire:loading.attr="disabled" class="btn theme-btn w-100">
                <span wire:loading wire:target="resetPassword">Checking records...</span>
                <span wire:loading.remove> Continue</span>
            </button>

            <h4 class="signup">Already have an account?<a wire:navigate.hover href="{{ route('login') }}"> Login</a>
            </h4>
        </div>
    </form>


</div>