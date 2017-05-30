<?php

namespace App\Events;
use Mail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Picqer\Barcode\BarcodeGeneratorHTML;

class TicketPurchased
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ticketdetails;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ticketdetails)
    {
        //
        $this->ticketdetails = $ticketdetails;
        $generator = new BarcodeGeneratorHTML();

        Mail::send('emails.send', ['details' => $ticketdetails, 'barcode'=> $generator->getBarcode($ticketdetails->id, $generator::TYPE_CODE_128)], function ($message)
        {

            $message->to('aogundipe@coolwazobiainfo.com');

        });
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
