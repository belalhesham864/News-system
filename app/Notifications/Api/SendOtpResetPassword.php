<?php

namespace App\Notifications\Api;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOtpResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

public $otp;
    public function __construct()
    {
        $this->otp=new Otp();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $otp=$this->otp->generate($notifiable->email,'numeric',7,30);
        return (new MailMessage)
        ->greeting('Reset password')
            ->line('Otp Code  Reset Your Password .')
              ->line('Code : ' .$otp->token)
            ->line('Thank you for using our '.env('APP_NAME'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
