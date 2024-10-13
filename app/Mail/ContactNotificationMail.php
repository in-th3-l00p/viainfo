<?php

namespace App\Mail;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactSubmission $submission
    ) {
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: __("VIAInfo Contact form submission"),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.contact-notification',
        );
    }
}
