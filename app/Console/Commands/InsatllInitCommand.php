<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InsatllInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '安装初始化配置文件';

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
        # 生成进度条 步数*5
        $progress = $this->output->createProgressBar(5);

        # 生成密钥
        \Artisan::call('key:generate');

        $progress->advance();

        # 执行数据回滚 - 数据迁移
        \Artisan::call('migrate:reset');

        $progress->advance();

        \Artisan::call('migrate');

        $progress->advance();

        # 执行数据填充
        \Artisan::call('db:seed');

        $progress->advance();

        # 清除缓存
        \Artisan::call('install:clear');

        $progress->finish();

        $this->info('安装完成');
    }
}
