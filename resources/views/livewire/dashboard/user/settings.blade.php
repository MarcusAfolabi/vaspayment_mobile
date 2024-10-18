 <section>
     <div class="custom-container">
         <ul class="notification-setting">
             <li class="setting-title">
                 <div class="notification pt-0">
                     <h3 class="fw-semibold dark-text">App notification</h3>
                 </div>
             </li>

             <li>
                 <div class="notification">
                     <h5 class="fw-normal dark-text">Transactional notifications</h5>
                     <div class="switch-btn">
                         <input type="checkbox" wire:model.lazy="notification" id="notification-toggle" />
                     </div>
                 </div>
             </li>

             <script>
                 document.addEventListener('livewire:load', function() {
                     const notificationToggle = document.getElementById('notification-toggle');

                     // Add event listener to the checkbox
                     notificationToggle.addEventListener('change', function() {
                         if (this.checked) {
                             // Initialize OneSignal and save the player ID when the checkbox is toggled on
                             window.OneSignalDeferred = window.OneSignalDeferred || [];
                             OneSignalDeferred.push(async function(OneSignal) {
                                 await OneSignal.init({
                                     appId: "ac40ca7d-8dc1-408b-ad17-ab8a587ae901",
                                 });

                                 OneSignal.on('subscriptionChange', function(isSubscribed) {
                                     if (isSubscribed) {
                                         OneSignal.getUserId(function(playerId) {
                                             // Send playerId to your backend for saving
                                             console.log("Player ID: ", playerId);
                                             savePlayerIdToBackend(playerId);
                                         });
                                     }
                                 });
                             });

                             function savePlayerIdToBackend(playerId) {
                                 fetch('https://api.vaspayment.com/api/v1/save-player-id', {
                                         method: 'POST',
                                         headers: {
                                             'Content-Type': 'application/json',
                                             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                         },
                                         body: JSON.stringify({
                                             player_id: playerId,
                                         })
                                     }).then(response => response.json())
                                     .then(data => console.log(data))
                                     .catch(error => console.error('Error:', error));
                             }
                         }
                     });
                 });
             </script>

             <li>
                 <div class="notification pb-0">
                     <h5 class="fw-normal dark-text">Utility news</h5>
                     <div class="switch-btn">
                         <input type="checkbox" checked />
                     </div>
                 </div>
             </li>

             <li>
                 <div class="notification">
                     <h5 class="fw-normal dark-text">Transaction Pin</h5>
                     <div class="switch-btn">
                         <input type="checkbox" />
                     </div>
                 </div>
                 <div class="form-group mt-4">
                     <label for="pin" class="form-label">For transaction checkout</label>
                     <div class="form-input" style="position: relative;" x-data="{
                            show: false,
                            pin1: '',
                            pin2: '',
                            pin3: '',
                            pin4: '',
                            focusNext(currentRef, nextRef) {
                                if (currentRef.value.length === 1) {
                                    nextRef.focus();
                                }
                            }
                        }"
                    >
                         <div style="display: flex; gap: 10px;">
                             <input :type="show ? 'text' : 'password'" inputmode="number" wire:model.blur="pin1" maxlength="1" x-ref="pin1" x-model="pin1" @input="focusNext($refs.pin1, $refs.pin2)" @focus="$el.setSelectionRange(0, 0)" class="form-control" style="width: 55px; text-align: center; caret-color: transparent; outline: none;" autofocus />

                             <input :type="show ? 'text' : 'password'" inputmode="number" wire:model.blur="pin2" maxlength="1" x-ref="pin2" x-model="pin2" @input="focusNext($refs.pin2, $refs.pin3)" @focus="$el.setSelectionRange(0, 0)" class="form-control" style="width: 55px; text-align: center; caret-color: transparent; outline: none;" />

                             <input :type="show ? 'text' : 'password'" inputmode="number" wire:model.blur="pin3" maxlength="1" x-ref="pin3" x-model="pin3" @input="focusNext($refs.pin3, $refs.pin4)" @focus="$el.setSelectionRange(0, 0)" class="form-control" style="width: 55px; text-align: center; caret-color: transparent; outline: none;" />

                             <input :type="show ? 'text' : 'password'" inputmode="number" wire:model.blur="pin4" maxlength="1" x-ref="pin4" x-model="pin4" @input="$el.blur()" @focus="$el.setSelectionRange(0, 0)" class="form-control" style="width: 55px; text-align: center; caret-color: transparent; outline: none;" />
                         </div>

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
                         font-size: 1.5rem;
                         text-align: center;
                         caret-color: transparent;
                         outline: none;
                     }

                     .form-input {
                         position: relative;
                     }
                 </style>

                 @error('pin')
                 <span class="text-danger">{{ $message }}</span>
                 @enderror

             </li>

         </ul>
     </div>
 </section>