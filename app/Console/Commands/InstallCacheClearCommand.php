<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class InstallCacheClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清除相关的缓存，并重新进行缓存配置';

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
        # 清除缓存
        \Artisan::call('config:clear');
        \Artisan::call('view:clear');
        \Artisan::call('route:clear');
        \Artisan::call('cache:clear');
        \Artisan::call('update:category');

        # 清除页面中的缓存
        Redis::del(\App\Models\Product::key);
        Redis::del(\App\Models\Product::latest);
        Redis::del(\App\Models\Banner::key);
        Redis::del(\App\Models\Category::key);

        # 这里由于之前设计的原因，我单个商品采用的是 key-vlaue的方式进行保存的，保存时间的 1 天
        # 当你在本地安装了这个 web 并且访问了的话，会有商品数据缓存
        # 我这里将对他们进行删除，默认商品id 1 - 1000 ， 循环1000次
        for ($i=1; $i<1000; $i++) {
            Redis::del(\App\Models\Product::simpleKey . $i);
        }

        # 清除活跃用户
        \Artisan::call('me:clear_active_user');

        # 提示信息
        $this->info('清除相关系列缓存完成');
    }
}
