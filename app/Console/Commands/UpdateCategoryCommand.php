<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class updateCategoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '异步触发缓存分类缓存更新/每五分钟';

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
        Category::setRedisCategory();
    }
}
