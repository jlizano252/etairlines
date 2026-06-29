<?php

namespace App\Mail;

use App\Models\EtairlinesRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EtairlinesBoardingPassMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public EtairlinesRegistration $registration) {}

    public function build()
    {
        return $this
            ->subject('Tu pase de abordaje ETAIRLINES')
            ->view('mail.etairlines-boarding-pass');
    }
}
