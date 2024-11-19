<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AssignIndiTaskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $indiTaskData;
    public function __construct($indiTaskData)
    {
        $this->indiTaskData = $indiTaskData;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Assign Individual Task Mail',
        );
    }

    public function content()
    {
        return new Content(
            view: 'admin.task.assigninditaskmail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
