
   <!-- Notificaiton -->
      <div class="dropdown">
        <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="badge badge-primary">{{$unreadNotificationsCount}}</span>
            <i class="i-Bell text-muted header-icon"></i>
        </div>
        <!-- Notification dropdown -->


        <div class="dropdown-menu dropdown-menu-right rtl-ps-none notification-dropdown"
        aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true" >
        @foreach ($notifications as  $notification)
        <div class="dropdown-item d-flex">
            <div class="notification-icon">
                <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
            </div>
            <div class="notification-details flex-grow-1">
                    <p class="m-0 d-flex align-items-center" >
                        <span>New message</span>
                        @if ($notification->unread())
                            <a class="text-white badge badge-pill badge-primary ml-1 mr-1" href="{{$notification['url']}}?notify_id={{$notification->id}}">new</a>

                        @endif
                        <span class="flex-grow-1"></span>
                        <span class="text-small text-muted ml-auto">{{$notification->created_at->diffForHumans()}}</span>
                    </p>
                    <p class="text-small text-muted m-0">{{$notification['data']['order']}}</p>
                </div>
            </div>

            @endforeach
        </div>
    </div>
    <!-- Notificaiton End -->
