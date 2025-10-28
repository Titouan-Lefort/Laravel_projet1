<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Univers;

class InfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public object $user;
    public ?Univers $univers;

    public function __construct(object $user, ?Univers $univers = null)
    {
        $this->user = $user;
        $this->univers = $univers;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Info Mail');
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.test',
            with: ['user' => $this->user, 'univers' => $this->univers]
        );
    }

    /**
     * Attachments to be sent with the mailable.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
