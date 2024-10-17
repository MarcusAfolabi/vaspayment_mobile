 <div class="offcanvas sidebar-offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft">
     <div class="offcanvas-header sidebar-header">
         <div class="sidebar-logo">
             @php
             $hour = date('H'); // Get current hour in 24-hour format
             if ($hour < 12) { $greeting='Good Morning' ; } elseif ($hour < 18) { $greeting='Good Afternoon' ; } else { $greeting='Good Evening' ; } @endphp <p>{{ $greeting }}, {{ $name }}</p>
         </div>
         <div class="balance">
             <img class="img-fluid balance-bg" src="{{ asset('assets/images/background/auth-bg.jpg') }}" alt="auth-bg" />
             <h5>Wallet Balance</h5>
             <h2>&#8358; {{ $balance }}</h2>
         </div>
     </div>
     <style>
         .menu-item {
             display: flex;
             /* Use flexbox for alignment */
             align-items: center;
             /* Center items vertically */
             text-decoration: none;
             /* Remove underline from links */
             padding: 8px 16px;
             /* Add padding for spacing */
             color: #000;
             /* Change color if needed */
         }

         .menu-item img {
             margin-right: 8px;
             /* Space between icon and label */
         }
     </style>
     <div class="offcanvas-body">
         <div class="sidebar-content">
             <ul class="link-section">
                 @foreach($menuItems as $item)
                 <li>
                     <a wire:navigate href="{{ $item['url'] }}" class="menu-item">
                         <img src="{{ $item['icon'] }}" alt="{{ $item['label'] }} Icon" width="24" height="24">
                         {{ $item['label'] }}
                     </a>
                 </li>
                 @endforeach
             </ul>
         </div>
     </div>
 </div>