<?php

namespace App\Jobs;

use App\Mail\SendQueryMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendQueryEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $recipients = [
                        // 'faizdev007@gmail.com', 
                        'ronnie@optimalvirtualemployee.com', 
                        'dshah@optimalvirtualemployee.com', 
                        'nakul@optimalvirtualemployee.com', 
                        'kartik@optimalvirtualemployee.com'
                    ];

        Mail::to($recipients)->send(new SendQueryMail($this->data));
    }
}
