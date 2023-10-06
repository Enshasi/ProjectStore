<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationMune extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $notifications;
    public $unreadNotificationsCount;
    public function __construct()
    {
         $user = Auth::user();
        $this->notifications = $user->notifications()->limit(10)->get();
        $this->unreadNotificationsCount = $user->unreadNotifications->count();
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notification-mune');
    }
}
