<?php

namespace App\Mail;

use App\Models\AppointmentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentRequestSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public AppointmentRequest $appointmentRequest) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Appointment Request',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment-request-submitted',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
