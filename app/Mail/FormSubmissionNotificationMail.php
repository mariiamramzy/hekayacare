<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FormSubmissionNotificationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public string $formName,
        public array $fields,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hekaya - '.$this->formName,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.form-submission-notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
