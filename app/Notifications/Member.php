<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Member extends Notification
{
    use Queueable;

    private $content;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content=$content;
    }

    /**
     * Get the notification's delivery channels.
     * @return array
     * @internal param mixed $notifiable
     */
    public function via()
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     * @return array
     * @internal param mixed $notifiable
     */
    public function toArray()
    {
        return [
            'content'=>$this->content
        ];
    }
}
