<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Redis\ActiveUserCache;
use App\Events\ActiveUser;

class AvtiveUserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ActiveUser $event)
    {
        return ActiveUserCache::setActiveUser($event->id,$event->grade);
    }
}
