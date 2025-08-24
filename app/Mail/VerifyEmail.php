<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $urlVerify;

    public function __construct($urlVerify)
    {
        $this->urlVerify = $urlVerify;
    }

    public function build()
    {
        return $this->subject('Verificación de correo electrónico.')
                    ->view('emails.verify');
    }
}