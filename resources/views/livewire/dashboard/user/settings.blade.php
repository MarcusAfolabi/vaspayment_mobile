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
         </ul>
     </div>
 </section>