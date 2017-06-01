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


class TicketPurchased
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ticketdetails;
    public $original;
    public $event;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ticketdetails, $original, $event)
    {
        //
        $this->ticketdetails = $ticketdetails;
        $this->original = $original;
        $this->event = $event;
     
    
        $qrCode = new \Arcanedev\QrCode\QrCode;
        $qrCode->setText($ticketdetails->id);
        $qrCode->setSize(200);

 

        Mail::send('emails.send', ['ticketpurchased' => $ticketdetails, 'original'=>$original, 'event'=>$event, 'barcode'=> $qrCode->image("image alt", ['class' => 'qr-code-img'])], function ($message) use ($ticketdetails)
        {
            $message->to($ticketdetails->email)->subject('Your Ticket has arrived');

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
