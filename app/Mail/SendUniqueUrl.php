<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendUniqueUrl extends Mailable
{
    use Queueable, SerializesModels;


    private string $uniqueCode;
    /**
     * Create a new message instance.
     */
    public function __construct($uniqueCode)
    {
        $this->uniqueCode = $uniqueCode;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('daniuyan71@gmail.com', 'Nerots'),
            subject: 'Send Unique Url',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.otp',
            with: [
                'otp' => $this->uniqueCode
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}