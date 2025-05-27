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
    private string $type;

    /**
     * Create a new message instance.
     */
    public function __construct(string $uniqueCode, string $type)
    {
        $this->uniqueCode = $uniqueCode;
        $this->type = $type;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('daniuyan71@gmail.com', 'Admin Tracer Study Polinema'),
            subject: 'Pengisian Formulir Tracer Study Politeknik Negeri Malang',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.mail',
            with: [
                'unique_url' => $this->uniqueCode,
                'type' => $this->type,
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
