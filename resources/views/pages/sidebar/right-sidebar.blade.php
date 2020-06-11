<!-- START RIGHT SIDEBAR NAV -->
<aside id="right-sidebar-nav">
  <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
    <div class="row">
      <div class="slide-out-right-title">
        <div class="col s12 border-bottom-1 pb-0 pt-1">
          <div class="row">
            <div class="col s2 pr-0 center">
              <i class="material-icons vertical-text-middle"><a href="#" class="sidenav-close">clear</a></i>
            </div>
            <div class="col s10 pl-0">
              <ul class="tabs">
                <li class="tab col s4 p-0">
                  <a href="#activity" class="active">
                    <span>Activity</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row slide-out-right-body pl-3">
        <div id="activity" class="col s12">
          <div class="activity">
            <p class="mt-5 mb-0 ml-5 font-weight-900">SYSTEM LOGS</p>
            <ul class="widget-timeline mb-0">
              @forelse(auth()->user()->notifications as $notification)
              <li class="timeline-items timeline-icon-{{ $notification->read_at ? 'green' : 'red' }} active">
                <div class="timeline-time">{{ Carbon\Carbon::make($notification->created_at)->diffForHumans() }}</div>
                <h6 class="timeline-title">{{ $notification->data['data'] }}</h6>
                <p class="timeline-text">Read at: {{ $notification->read_at ? Carbon\Carbon::make($notification->read_at)->toDateTimeString() : 'unread' }}</p>
              </li>
              @empty
              <li>
                No New Notifications!
              </li>
              @endforelse       
          </div>
        </div>
      </div>
    </div>
  </div>
</aside>
<!-- END RIGHT SIDEBAR NAV -->