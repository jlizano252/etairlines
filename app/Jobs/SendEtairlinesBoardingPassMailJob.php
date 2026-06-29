<?php

namespace App\Jobs;

use App\Mail\EtairlinesBoardingPassMail;
use App\Models\EtairlinesRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEtairlinesBoardingPassMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 120;

    public function __construct(public int $registrationId) {}

    public function handle(): void
    {
        $registration = EtairlinesRegistration::findOrFail($this->registrationId);

        if (! $registration->email) {
            return;
        }

        Mail::to($registration->email)->send(new EtairlinesBoardingPassMail($registration));

        $registration->update([
            'email_sent_at' => now(),
        ]);
    }
}
