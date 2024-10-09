<div>
    <form wire:submit.prevent='register' class="auth-form">
        <div class="custom-container">
            <p class="text-danger" wire:offline>
                Whoops, your device has lost connection.
            </p>
            <div class="form-group">
                <label for="name" class="form-label">First name</label>
                <div class="form-input">
                    <input wire:model='name' name='name' type="text" class="form-control" placeholder="Enter Your Name" />
                </div>
            </div>
            @error('name')
            <em class="text-danger">{{ $message }}</em>
            @enderror
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="form-input">
                    <input wire:model.lazy='email' name='email' type="email" class="form-control" placeholder="Enter Your Email" />
                </div>
            </div>
            @error('email')
            <em class="text-danger">{{ $message }}</em>
            @enderror
            <div class="form-group">
                <label for="phone" class="form-label">Phone</label>
                <div class="input-group">
                    <select wire:model="countryCode" class="form-select">
                        <option value="">Select Country</option>
                        <option value="234" data-flag="NG">🇳🇬 +234</option>
                        <!-- <option value="254" data-flag="KE">🇰🇪 +254</option>
                        <option value="233" data-flag="GH">🇬🇭 +233</option>
                        <option value="27" data-flag="ZA">🇿🇦 +27</option>
                        <option value="255" data-flag="TZ">🇹🇿 +255</option>
                        <option value="256" data-flag="UG">🇺🇬 +256</option>
                        <option value="250" data-flag="RW">🇷🇼 +250</option>
                        <option value="265" data-flag="MW">🇲🇼 +265</option>
                        <option value="237" data-flag="CM">🇨🇲 +237</option>
                        <option value="261" data-flag="MG">🇲🇬 +261</option> -->
                    </select>
                    <input wire:model.blur='phone' maxlength="10" name='phone' type="tel" class="form-control" placeholder="Enter Your Phone" />
                </div>
                @error('phone')
                <em class="text-danger">{{ $message }}</em>
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
                    <input type="number" id="refer_id" inputmode="numeric" placeholder="e.g 12345678" wire:model.lazy="refer_id" class="form-control" oninput="this.value = this.value.slice(0, 8);">
                </div>
            </div>
            @error('refer_id')
            <em class="text-danger">{{ $message }}</em>
            @enderror
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="form-input" style="position: relative;" x-data="{ show: false }">
                    <input :type="show ? 'text' : 'password'" wire:model="password" name="password" class="form-control" placeholder="Enter Your preferred password" style="padding-right: 45px;" />

                    <!-- Toggle Button -->
                    <button type="button" @click="show = !show" class="toggle-password-btn">
                        <span x-text="show ? 'Hide' : 'Show'"></span>
                    </button>
                </div>
            </div>

            @error('password')
            <em class="text-danger">{{ $message }}</em>
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
            <em class="text-danger">{{ $message }}</em>
            @enderror
            <div class="remember-option mt-3">
                <div class="form-check">
                    <input wire:model='agreed' class="form-check-input" type="checkbox" value="yes" />
                    <label class="form-check-label" for="flexCheckDefault">I agree to the <a wire:navigate href="#">Terms</a> and <a wire:navigate href="#">Privacy</a> </label>
                </div>
            </div>
            @error('agreed')
            <em class="text-danger">{{ $message }}</em>
            @enderror

            <input hidden value="{{ $location_data }}" wire:model='location_data' />
            @error('location_data')
            <em class="text-danger">{{ $message }}</em>
            @enderror

            <input hidden value="{{ $device_data }}" wire:model="device_data">
            @error('device_data')
            <em class="text-danger">{{ $message }}</em>
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