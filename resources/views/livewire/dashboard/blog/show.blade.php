  <section class="section-b-space">
      <div class="custom-container">
          <div class="news-details">
              @if (!empty($show) && !empty($show['image']))
              <img class="img-fluid news-img w-100" src="{{ 'https://vaspayment.com/' . $show['image'] }}" alt="{{ $show['title'] }}" />
              @endif
              <div class="news-content">
                  <div class="d-flex justify-content-between align-items-center">
                      <h2>{{ $show['title'] ?? '' }}</h2>
                      <h5>
                          @if (\Carbon\Carbon::parse($show['created_at'])->isToday())
                          Today - {{ \Carbon\Carbon::parse($show['created_at'])->format('h:i A') }} <!-- Show time for today -->
                          @elseif (\Carbon\Carbon::parse($show['created_at'])->isYesterday())
                          Yesterday - {{ \Carbon\Carbon::parse($show['created_at'])->format('h:i A') }} <!-- Show time for yesterday -->
                          @else
                          {{ \Carbon\Carbon::parse($show['created_at'])->format('D, jS F, Y') }} <!-- Show full date for other days -->
                          @endif
                      </h5>
                      <h6>
                          <img src="{{ asset('assets/feather/eye.svg') }}" style="height:15px; width:15px;" /> {{ $show['views'] }}
                      </h6>
                  </div>
                  <div class="news-description">
                      <p>{{ $show['description'] }}</p>

                      <div class="investment-banner">
                          <div class="investment-content">
                              <!-- google ads -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>