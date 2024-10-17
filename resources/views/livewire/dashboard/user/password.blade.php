  <section>
      <div class="custom-container">
          <h4 class="fw-normal light-text lh-base">Enter your registered email to change your passwords.
          </h4>
          <form class="auth-form pt-0 mt-3">
              @if ($emailx)
              <div class="form-group">
                  <label for="inputpin" class="form-label">Email</label>
                  <input type="email" class="form-control" wire:model.blur="email" placeholder="Enter your email" />
              </div>
              @error('email')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              @endif

              @if ($otpSent)
              <div class="form-group">
                  <label for="email" class="form-label text-success">Enter the otp sent</label>
                  <div class="form-input">
                      <input type="number" inputmode="numeric" placeholder="Enter email confirmation code" wire:model.blur="email_code" class="form-control" oninput="this.value = this.value.slice(0, 6);">
                  </div>
              </div>
              @error('email_code')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              @endif

              @if ($newPassword)
              <div class="form-group">
                  <label for="password" class="form-label">New Password</label>
                  <div class="form-input" style="position: relative;" x-data="{ show: false }">
                      <input :type="show ? 'text' : 'password'" wire:model.blur="password" class="form-control" placeholder="Enter your new password" style="padding-right: 45px;" />

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
              <span class="text-danger">{{ $message }}</span>
              @enderror

              @endif
          </form>
      </div>
  </section>