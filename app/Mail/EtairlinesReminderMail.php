<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EtairlinesReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $mailSubject;
    public string $messageText;

    public function __construct(string $subject, string $messageText)
    {
        $this->mailSubject = $subject;
        $this->messageText = $messageText;
    }

    public function build()
    {
        return $this
            ->subject($this->mailSubject)
            ->view('mail.etairlines-reminder')
            ->with([
                'subject' => $this->mailSubject,
                'messageText' => $this->messageText,
            ]);
    }
}