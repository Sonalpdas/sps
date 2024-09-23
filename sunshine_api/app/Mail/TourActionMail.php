<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TourActionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $action;
    public $data;
    public $recipientType;

    /**
     * Create a new message instance.
     *
     * @param string $action The action that was performed (e.g., add, update, delete)
     * @param array $data The data of the contact
     * @param string $recipientType The recipient type ('user' or 'organization')
     */
    public function __construct($action, $data, $recipientType)
    {
        $this->action = $action;
        $this->data = $data;
        $this->recipientType = $recipientType;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Tour {$this->action} Notification"
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Determine the view based on recipient type (user or organization)
        $view = $this->recipientType == 'user' ? 'emails.contact_user' : 'emails.contact_organization';

        return new Content(
            view: $view,
            with: ['data' => $this->data]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}