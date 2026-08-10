<?php

namespace App\Jobs;

use App\Mail\EtairlinesReminderMail;
use App\Models\EmailCampaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEtairlinesReminderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public int $campaignId;

    public string $email;
    public string $name;
    public string $subject;
    public string $message;


    public int $tries = 3;

    public int $timeout = 120;



    public function __construct(
        int $campaignId,
        string $email,
        string $name,
        string $subject,
        string $message
    ) {

        $this->campaignId = $campaignId;

        $this->email = $email;
        $this->name = $name;
        $this->subject = $subject;
        $this->message = $message;
    }



    public function handle(): void
    {
        try {

            $mensajePersonalizado = str_replace(
                '{nombre}',
                $this->name,
                $this->message
            );


            Mail::to($this->email)->send(
                new EtairlinesReminderMail(
                    $this->subject,
                    $mensajePersonalizado
                )
            );


            // Aumentar enviados
            EmailCampaign::where('id', $this->campaignId)
                ->increment('sent');
        } catch (\Throwable $e) {


            // Aumentar fallidos
            EmailCampaign::where('id', $this->campaignId)
                ->increment('failed');


            throw $e;
        }



        // Revisar si terminó la campaña
        $campaign = EmailCampaign::find($this->campaignId);


        if ($campaign) {

            if (
                ($campaign->sent + $campaign->failed)
                >=
                $campaign->total
            ) {

                $campaign->update([
                    'status' => 'completed'
                ]);
            }
        }
    }
    public function failed(\Throwable $exception): void
    {
        EmailCampaign::where('id', $this->campaignId)
            ->increment('failed');
    }
}
