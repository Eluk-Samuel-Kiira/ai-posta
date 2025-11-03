<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MagicLoginLink extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $isWelcomeEmail;

    public function __construct($token, $isWelcomeEmail = false)
    {
        $this->token = $token;
        $this->isWelcomeEmail = $isWelcomeEmail;
    }

    public function build()
    {
        $subject = $this->isWelcomeEmail 
            ? 'Welcome! Your Magic Login Link'
            : 'Your Magic Login Link';

        return $this->subject($subject)
                    ->markdown('emails.magic-login-link')
                    ->with([
                        'token' => $this->token,
                        'isWelcomeEmail' => $this->isWelcomeEmail,
                    ]);
    }
}