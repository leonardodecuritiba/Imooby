<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyContact extends Mailable
{
    use Queueable, SerializesModels;

    public $mensagem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Retorno de contato')
            ->text('emails.reply')
            ->with('mensagem', $this->mensagem);
    }
}
