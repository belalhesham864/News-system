<?php

namespace App\Jobs;

use App\Notifications\Api\SendOtpRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendOtpTask implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $user;
    public $tries=6;
    
    public function __construct($user)
    {
        $this->user=$user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
          $this->user->notify(new SendOtpRegister());
    }
}
