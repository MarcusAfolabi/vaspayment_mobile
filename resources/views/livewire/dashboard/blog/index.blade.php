 <section class="section-b-space">
     <div class="custom-container">
         <div class="row gy-3">
             @if ($blogs)
             @foreach ($blogs as $blog)
             <div class="col-12">
                 <div class="news-update-box">
                     <div class="d-flex align-items-center gap-3">
                         <a href="{{ route('show.insight', $blog['slug']) }}">
                             <img class="img-fluid news-update-image" src="{{ 'https://vaspayment.com/' . $blog['image'] }}" alt="{{ $blog['title'] }}" />
                         </a>
                         <div class="news-update-content">
                             <a href="{{ route('show.insight', $blog['slug']) }}">
                                 <h3>{{ $blog['title'] }} </h3>
                             </a>
                             <div class="news-writer">
                                 <h6>
                                     @if (\Carbon\Carbon::parse($blog['created_at'])->isToday())
                                     Today - {{ \Carbon\Carbon::parse($blog['created_at'])->format('h:i A') }} <!-- Show time for today -->
                                     @elseif (\Carbon\Carbon::parse($blog['created_at'])->isYesterday())
                                     Yesterday - {{ \Carbon\Carbon::parse($blog['created_at'])->format('h:i A') }} <!-- Show time for yesterday -->
                                     @else
                                     {{ \Carbon\Carbon::parse($blog['created_at'])->format('D, jS F, Y') }} <!-- Show full date for other days -->
                                     @endif
                                 </h6>
                                 <h6>
                                     <img src="{{ asset('assets/feather/eye.svg') }}" style="height:15px; width:15px;" /> {{ $blog['views'] }}
                                 </h6>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             @endforeach
             @else
             <p class="theme-color d-flex justify-content-center">No financial insight available, check back pls.</p>
             @endif 
         </div>
     </div>
 </section>