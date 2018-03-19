<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class vendorRegistered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param $vendor
     */
    public function __construct($vendor)
    {
        $this->vendor = $vendor;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('CoolFM Tickets Vendor Registration')
                    ->greeting('Hello '. $this->vendor->name)
                    ->line('We have received your request to become an offline vendor')
                    ->line('we will process your request and contact you shortly')
                    ->line('Thank You, and enjoy your day!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
