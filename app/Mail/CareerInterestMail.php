<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CareerInterestMail extends Mailable
{
    use Queueable, SerializesModels;


    public $careerInterestData;
    public function __construct($careerInterestData)
    {
        $this->careerInterestData = $careerInterestData;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Career Interest Update Mail',
        );
    }

    public function content()
    {
        return new Content(
            view: 'admin.studentcareeroption.careerinterestmail',
        );
    }

    public function attachments()
    {
        return [];
    }
}
