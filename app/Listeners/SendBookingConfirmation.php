<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\BookingCreatedMail; 
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail; 

class SendBookingConfirmation implements ShouldQueue
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
        
        Mail::to($event->booking->user->email)->send(new BookingCreatedMail($event->booking));
    }
}
