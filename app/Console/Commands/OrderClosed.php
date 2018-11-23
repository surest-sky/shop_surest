<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;
use App\Jobs\IncrProductStock;

class OrderClosed extends Command
{
    /**
     * 这个命令可忽略
     *
     * @var string
     */
    protected $signature = 'me:orderClosed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '将过期的订单修改为关闭状态';

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
        $orders = Order::where('expir_at','<=',Carbon::now())->where('closed','0')->get(['extra','id']);
        foreach ($orders as $order) {
            $order->closed = '1';
            $order->save();
            IncrProductStock::dispatch($order);
        }

    }
}
