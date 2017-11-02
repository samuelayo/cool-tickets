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
     
    
        // $qrCode = new \Arcanedev\QrCode\QrCode;
        // $qrCode->setText($ticketdetails->id);
        // $qrCode->setSize(200);
        // $filename = 'uploads/'.$ticketdetails->id.'.jpg';
        // $qrCode->save($filename);
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $idevn = explode('-',$ticketdetails->id);
       //$img =  '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($idevn[0].$idevn[1].$idevn[2], $generator::TYPE_CODE_128)) . '">';
        //dd($img);

   

   
    $fileName = 'uploads/'.$ticketdetails->id.'.png';
    $imageData = $generator->getBarcode($idevn[0].$idevn[1].$idevn[2], $generator::TYPE_CODE_128); 
    file_put_contents($fileName, $imageData);


        Mail::send('emails.send', ['ticketpurchased' => $ticketdetails, 'original'=>$original, 'event'=>$event], function ($message) use ($ticketdetails)
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
