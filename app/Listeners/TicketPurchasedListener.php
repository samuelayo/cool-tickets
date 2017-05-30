<?php

namespace App\Listeners;

use App\Events\TicketPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketPurchasedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TicketPurchased  $event
     * @return void
     */
    public function handle(TicketPurchased $event)
    {
        //
    }
}
