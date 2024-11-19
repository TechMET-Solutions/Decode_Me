<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookSessionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bookSessionMailData;
    public function __construct($bookSessionMailData)
    {
        $this->bookSessionMailData = $bookSessionMailData;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'DM Session Booked Confirmation mail.',
        );
    }

    public function content()
    {
        return new Content(
            view: 'admin.dmsession.booksessionmail',
        );
    }

    public function attachments()
    {
        return [];
    }
}
