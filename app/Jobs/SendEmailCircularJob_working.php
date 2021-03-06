<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailCircular;
use Mail;


class SendEmailCircularJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }



    /**
     * Execute the job.
     *
     * @return void
     */





    public function handle()
    {
        $sub = "Circular - MOM";
        $email = new SendEmailCircular();
        Mail::to('info@mallofmuscat.com', 'Info')
            ->bcc($this->details['email'])
            ->send($email);
    }
}
