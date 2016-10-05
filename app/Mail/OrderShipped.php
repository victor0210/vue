<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * @param array $arr
     */
    public function __construct(array $arr)
    {
        $this->arr = $arr;
    }

    /**
     * Build the message.
     *
     */
    public function build()
    {
        return $this->from('305945915@qq.com')
            ->view('emails.mail-welcome')
            ->with([
                'email' => $this->arr['email'],
                'activationcode' => $this->arr['activationcode']
            ]);
    }
}
