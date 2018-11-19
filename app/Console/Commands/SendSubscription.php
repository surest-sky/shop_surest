<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionMail;

class SendSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'me:subSend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '给订阅用户发送最近的商品信息';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = \App\Models\Subscriber::getSubscription()->pluck('email');

        foreach ($users as $user) {
            Mail::to($user)->queue(new SubscriptionMail());
        }

    }

}
