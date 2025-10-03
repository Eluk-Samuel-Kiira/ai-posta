<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
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

    public function envelope()
    {
        $subject = $this->isWelcomeEmail 
            ? 'Welcome to AI Assisted Posting - Your Magic Login Link'
            : 'Your Magic Login Link for AI Assisted Posting';

        return new Envelope(
            subject: $subject,
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.magic-login-link',
            with: [
                'token' => $this->token,
                'isWelcomeEmail' => $this->isWelcomeEmail,
                'loginUrl' => route('auth.authenticate', $this->token),
            ],
        );
    }

    public function attachments()
    {
        return [];
    }
}