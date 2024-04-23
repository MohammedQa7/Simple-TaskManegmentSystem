<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $assigned_user;
    public $maneger;
    public function __construct($assigned_user , $maneger)
    {
        $this->assigned_user = $assigned_user;
        $this->maneger = $maneger;
    }

    /**
     * Get the notification's delivery channels.]
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Task For You')
                    ->greeting('Hello' . ' ' .$this->assigned_user->name)
                    ->line('New task added for you by' . ' ' . $this->maneger->name )
                    ->action('See New Tasks', url('/tasks'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
