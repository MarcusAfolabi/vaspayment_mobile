<div>
    <form wire:submit.prevent='register' class="auth-form">
        <div class="custom-container">
           <p class="text-danger" wire:offline>
                Whoops, your device has lost connection.
            </p>
            <div class="form-group">
                <label for="name" class="form-label">First name</label>
                <div class="form-input">
                    <input wire:model.lazy='name' name='name' type="text" class="form-control"
                        placeholder="Enter Your Name" />
                </div>
            </div>
            @error('name')
                <em class="text-danger">{{ $message }}</em>
            @enderror
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
                <label for="phone" class="form-label">Phone</label>
                <div class="form-input">
                    <input wire:model.lazy='phone' name='phone' pattern="^0(?:70|71|80|81|90|91)[0-9]{8}$"
                        type="number" class="form-control" placeholder="Enter Your Phone" />
                </div>
            </div>
            @error('phone')
                <em class="text-danger">{{ $message }}</em>
            @enderror
            <div class="form-group">
                <label for="phone" class="form-label">Referral ID (Optional)</label>
                <div class="form-input">
                    <input type="number" maxlength="8" placeholder="e.g 12345678" minlength="8"
                        wire:model.lazy="refer_id" class="form-control" autocomplete="refer_id">
                </div>
            </div>
            @error('refer_id')
                <em class="text-danger">{{ $message }}</em>
            @enderror
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="form-input">
                    <input wire:model.lazy='password' name='password' type="password" class="form-control"
                        placeholder="Enter Your preferred password" />
                </div>
            </div>
            @error('password')
                <em class="text-danger">{{ $message }}</em>
            @enderror

            @error('error')
                <em class="text-danger">{{ $message }}</em>
            @enderror
            <div class="remember-option mt-3">
                <div class="form-check">
                    <input wire:model.lazy='agreed' class="form-check-input" type="checkbox" value="yes" />
                    <label class="form-check-label" for="flexCheckDefault">I agree to the <a wire:navigate
                            href="#">Terms</a> and <a wire:navigate href="#">Privacy</a> </label>
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
