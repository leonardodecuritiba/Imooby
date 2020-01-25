<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NegociateNotify extends Notification implements ShouldQueue
{
    use Queueable;
    private $name;
    private $subject;
    private $title;
    private $message;
    private $recomendation;
    private $postcript;
    private $link;

    /**
     * Create a new notification instance.
     *
     */
    public function __construct($data)
    {
        $this->subject = $data['subject'];
        $this->name = $data['name'];
        $this->title = isset($data['title'])?$data['title']:NULL;
        $this->message = $data['message'];
        $this->recomendation = isset($data['recomendation'])?$data['recomendation']:NULL;
        $this->link = isset($data['link'])?$data['link']:NULL;
        $this->postcript = isset($data['postcript'])?$data['postcript']:NULL;
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
            ->line($this->recomendation)
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
