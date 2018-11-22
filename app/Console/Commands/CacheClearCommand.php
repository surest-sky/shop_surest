<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class cacheClearCommand extends Command
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

        Redis::del(\App\Models\Product::key);
        Redis::del(\App\Models\Banner::key);
        Redis::del(\App\Models\Category::key);

        \Artisan::call('me:clear-active-user');

        # 提示信息
        $this->info('清除相关系列缓存完成');
    }
}
