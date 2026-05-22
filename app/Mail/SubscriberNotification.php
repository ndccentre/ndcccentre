<?php

namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriberNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $subject_line,
        public string $heading,
        public string $body,
        public ?string $buttonText = null,
        public ?string $buttonUrl = null,
        public ?Subscriber $subscriber = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->subject_line);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.subscriber-notification');
    }
}
