<?php

namespace App\Notifications\UtilityPayment;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FailedPaymentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($amount, $utility)
    {
        $this->amount = $amount;
        $this->utility = $utility;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->line($this->utility . ' payment is unsuccessful.')
                    ->action('Payment of KES ' . $this->amount . ' is unsuccessful.', url('/'))
                    ->line('Thank you for using LipiaUtilities!');
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
            'message' => 'Payment of KES ' 
                            . $this->amount 
                            . ' for ' 
                            . $this->utility 
                            . ' is unsuccessful.',
        ];
    }
}
