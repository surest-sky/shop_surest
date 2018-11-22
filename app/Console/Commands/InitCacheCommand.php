<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '优化系列的加载';

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
        # 清除相关的缓存
        \Artisan::call('install:clear');

        \Artisan::call('config:cache');
        \Artisan::call('route:cache');

        $this->info('优化相关的配置项完成');

    }
}
