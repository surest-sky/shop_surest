<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Adminer extends Authenticatable
{

    /**
     *  通知到管理员
     */
    use Notifiable;

    protected $mail;

    public function __construct()
    {
        $this->mail = config('mail.from.address');
    }

    public function routeNotificationForMail($notification)
    {
        return $this->mail;
    }

}