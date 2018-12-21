<?php

namespace App\Notifications\Api\V1\Client;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LoanProposalCreateNotification extends Notification
{
    use Queueable;

    public $emisCreatedData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($emisCreatedData)
    {
        $this->emisCreatedData = $emisCreatedData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Todo : Remove comment to send mail
        //return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        /*return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');*/

        // Todo : Send Notification to Client on Creating Proposal and its details
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

        // Todo : Send Channel a response on Creating Proposal and its details
    }
}
