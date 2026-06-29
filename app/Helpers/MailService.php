<?php

namespace App\Helpers;

use App\Mail\RegisterMailNotification;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public static function sendRegisterMailNotification(array $params): void
    {
        static $delay = 0;

        $email = new RegisterMailNotification($params);

        Mail::to([$params['email']])
            ->bcc(['vetc@centroatenea.network'])
            ->later(now()->addSeconds($delay), $email);

        $delay += 10;
    }
}
