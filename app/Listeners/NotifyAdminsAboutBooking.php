<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Notifications\NewBooking; 
use App\Models\User; 
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification; 

class NotifyAdminsAboutBooking implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookingCreated $event): void
    {
        sleep(3);

        $admins = User::where('is_admin', true)->get(); 

        Notification::send($admins, new NewBooking($event->booking));
    }
}
