<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $products;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($products='')
    {
//        $this->products  = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('shop.surest.cn的订阅通知')->view('emails.sub.list');
    }
}
