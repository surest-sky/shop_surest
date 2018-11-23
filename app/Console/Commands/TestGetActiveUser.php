<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class getActiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:getActiveUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '测试使用： 获取活跃用户的信息';

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
        dd($ids = \App\Redis\ActiveUserCache::getActiveUser(5));
    }
}
