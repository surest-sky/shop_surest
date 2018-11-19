<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Redis\ActiveUserCache;
use Illuminate\Support\Facades\Redis;

class AnewActiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'me:anewActiveUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每10天重新计算活跃用户，清除活跃用户信息， 0.00';

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
     * @return mixed
     */
    public function handle()
    {
        $ids = ActiveUserCache::getActiveUser(5);

        ActiveUserCache::delActiveUser();

        # 清除一下每日的登录用户信息
        $key = config('rket.login_key');
        Redis::del($key);

        if( !$ids ) {
            return ;
        }

        $ids = array_keys($ids);

        foreach ($ids as $id) {
            ActiveUserCache::setActiveUser($id,2);
        }
    }
}
