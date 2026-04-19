<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
class NewCommentNotify extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $comment ,$post,$commenter;
    public function __construct($comment,$post,$commenter)
    {
      $this->comment=$comment;
      $this->post=$post;
      $this->commenter=$commenter;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
      return [

      ];
    }
    public function toDatabase(object $notifiable): array
    {
  return [
            'user_id'=>$this->comment->user_id,
            'username'=>$this->commenter->username,
            'post_title'=>$this->post->title,
            'comment'=>$this->comment->comment,
            'link'=>route('forntend.post.show',$this->post->slug),

        ];
    }
   public function toBroadcast(object $notifiable): BroadcastMessage
{
    return new BroadcastMessage([
        'user_id' => $this->comment->user_id,
        'username' => $this->commenter->username,
        'post_title' => $this->post->title,
        'comment' => $this->comment->comment,
        'link' => route('forntend.post.show', $this->post->slug),
            'delete_link' => route('forntend.dashboard.notifaction.deleteone', '__id__'),
    ]);
}
//     public function broadcastType(): string
// {
//     return 'NewCommentNotify';
// }
public function databaseType(object $notifiable): string
{
    return 'NewCommentNotify';
}
}
