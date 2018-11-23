<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Redis\ActiveUserCache;
use Illuminate\Support\Facades\Redis;

class MeAnewActiveUser extends Command
{
    /**
     * 命令名称：
     *  重新计算活跃用户
     *
     * @var string
     */
    protected $signature = 'me:anewActiveUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每10天重新计算活跃用户，清除活跃用户信息，time: 0.00';

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
     *
     * @return mixed
     */
    public function handle()
    {
        # 获取前6个活跃用户
        # 保持前6个用户保持活跃积分延续到下一个结分阶段
        $ids = ActiveUserCache::getActiveUser(5);

        # 删除所有活跃用户的缓存
        ActiveUserCache::delActiveUser();

        # 当缓存中没有活跃用户的时候，给予0操作
        if( !$ids ) {
            return ;
        }


        # 清除一下每日的登录用户信息
        # 清除的是所有的活跃用户，如果不清楚当日的活跃用户信息，将导致，当前活跃用户的分数不被计分
        \Artisan::call('me:clear-active-user');

        $ids = array_keys($ids);

        # 获取到的5个最新活跃用户
        # 重新给分，保持页面活跃用户存在
        foreach ($ids as $id) {
            ActiveUserCache::setActiveUser($id,2);
        }
    }
}
