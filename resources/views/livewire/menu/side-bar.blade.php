 <div class="offcanvas sidebar-offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft">
     <div class="offcanvas-header sidebar-header">
         <div class="sidebar-logo">
             <img class="img-fluid logo" src="{{ $logo }}" alt="logo" />
         </div>
         <div class="balance">
             <img class="img-fluid balance-bg" src="{{ asset('assets/images/background/auth-bg.jpg') }}" alt="auth-bg" />
             <h5>Wallet Balance</h5>
             <h2>&#8358; {{ $balance }}</h2>
         </div>
     </div>
     <div class="offcanvas-body">
         <div class="sidebar-content">
             <ul class="link-section">
                 @foreach ($menuItems as $menu)
                 <li>
                     <a href="{{ $menu['url'] }}" class="pages">
                         <i class="sidebar-icon" data-feather="{{ $menu['icon'] }}"></i>
                         <h3>{{ $menu['label'] }}</h3>
                     </a>
                 </li>
                 @endforeach
             </ul>
             <div class="mode-switch">
                 <ul class="switch-section">
                     <li>
                         <h3>Dark</h3>
                         <div class="switch-btn">
                             <input id="dark-switch" type="checkbox" />
                         </div>
                     </li>
                     <li>
                         <h3>About us</h3>
                         <div class="switch-btn">
                             {{-- <input id="dark-switch" type="checkbox" /> --}}
                         </div>
                     </li>
                     <li>
                         <h3>Privacy Policy</h3>
                         <div class="switch-btn">
                             {{-- <input id="dark-switch" type="checkbox" /> --}}
                         </div>
                     </li>
                     <li>
                         <h3>Contact us</h3>
                         <div class="switch-btn">
                             {{-- <input id="dark-switch" type="checkbox" /> --}}
                         </div>
                     </li>
                     <li>
                         <h3>
                             <form action="{{ route('logout') }}" method="POST">
                                 @csrf
                                 <button type="submit" class="btn theme-btn w-100">Logout</button>
                             </form>
                         </h3>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </div>