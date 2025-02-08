<div>
    <form wire:submit.prevent='register' class="auth-form">
        <div class="custom-container">
            <p class="text-danger" wire:offline>
                Whoops, your device has lost connection.
            </p>
            <div class="form-group">
                <label for="name" class="form-label">First name</label>
                <div class="form-input">
                    <input wire:model='name' type="text" class="form-control" autocomplete="name" placeholder="Enter your firstname" />
                </div>
            </div>
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label for="name" class="form-label">Last name</label>
                <div class="form-input">
                    <input wire:model='lastname' type="text" class="form-control" autocomplete="family-name" placeholder="Enter your lastname" />
                </div>
            </div>
            @error('lastname')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="form-input">
                    <input wire:model.lazy='email' autocomplete="username" type="email" class="form-control" placeholder="Enter your email" />
                </div>
            </div>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label for="phone" class="form-label">Phone</label>
                <div class="input-group">
                    <select wire:model="countryCode" class="form-select">
                        <option value="">Select Country</option>
                        <option value="234" data-flag="NG">🇳🇬 +234</option>
                    </select>
                    <input wire:model.blur='phone' maxlength="11" minlength="11" autocomplete="mobile" name='phone' type="tel" class="form-control" placeholder="Enter your phone" />
                </div>
                @error('phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <style>
                .country-select option {
                    padding-left: 30px;
                    background-repeat: no-repeat;
                    background-position: left center;
                }
            </style>

            <div class="form-group">
                <label for="phone" class="form-label">Referral ID (Optional)</label>
                <div class="form-input">
                    <input type="number" id="refer_id" inputmode="numeric" placeholder="e.g 12345678" wire:model="refer_id" class="form-control" oninput="this.value = this.value.slice(0, 8);">
                </div>
            </div>

            @error('refer_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="form-input" style="position: relative;" x-data="{ show: false }">
                    <input :type="show ? 'text' : 'password'" wire:model="password" autocomplete="new-password" name="password" class="form-control" placeholder="Enter your preferred password" style="padding-right: 45px;" />

                    <!-- Toggle Button -->
                    <button type="button" @click="show = !show" class="toggle-password-btn">
                        <span x-text="show ? 'Hide' : 'Show'"></span>
                    </button>
                </div>
            </div>

            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
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



            @error('error')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="remember-option mt-3">
                <div class="form-check">
                    <input wire:model='agreed' class="form-check-input" type="checkbox" value="yes" />
                    <label class="form-check-label" for="flexCheckDefault">I agree to the <a wire:navigate href="#">Terms</a> and <a wire:navigate href="#">Privacy</a> </label>
                </div>
            </div>
            @error('agreed')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <button type="submit" wire:loading.attr="disabled" class="btn theme-btn w-100">
                <span wire:loading wire:target="register">Saving records...</span>
                <span wire:loading.remove> Register</span>
            </button>
            <h4 class="signup">Already have an account?<a wire:navigate.hover href="{{ route('login') }}"> Login</a>
            </h4>
        </div>
    </form>
</div>