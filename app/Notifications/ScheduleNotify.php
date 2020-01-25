<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ScheduleNotify extends Notification implements ShouldQueue
{
    use Queueable;
    private $name;
    private $subject;
    private $message;
    private $link;

    /**
     * Create a new notification instance.
     *
     */
    public function __construct($data)
    {
        $this->subject = $data['subject'];
        $this->name = $data['name'];
        $this->message = $data['message'];
        $this->link = $data['link'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Olá ' . $this->name . ',')
            ->subject($this->subject)
            ->line($this->message)
            ->action('Clique aqui', $this->link);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
