<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InstallmentDueToday extends Notification
{
    private $deal;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($deal)
    {
        $this->deal = $deal;
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
            ->subject('Hey admin, Installment Due Today')
            ->greeting('Hello', 'admin')
            ->line('Installment of property name: ' . $this->deal->property->name . ', Deal: ' . $this->deal->title . ' is due today!')
            ->line('for customer: ' . $this->deal->customer->fullname)
            ->line('floor #: ' . $this->deal->property->floor_no . ' and appartment #: ' . $this->deal->property->apartment_no)
            ->line('by agent: ' . $this->deal->user->fullname())
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'data' => 'Installment of customer: ' . $this->deal->customer->fullname . 'Deal: ' . $this->deal->title . ' is due today!',
        ];
    }
}
