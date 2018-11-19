<?php

namespace App\Events;

use App\Redis\ActiveUserCache;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActiveUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;

    public $grade;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($id,$grade)
    {
        $this->id = $id;
        $this->grade = $grade;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

    }
}
