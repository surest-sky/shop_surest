<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subscriber extends Model
{
    use Notifiable;

    public $guarded = [];

    public static function getSubscription()
    {
        return self::query()->where('closed','0')->orderBy('created_at','DESC')->get();
    }
}
