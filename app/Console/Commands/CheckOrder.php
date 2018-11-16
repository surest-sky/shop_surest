<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;
use App\Jobs\IncrProductStock;

class CheckOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:closed';

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
        }

        $extras = $orders->pluck('extra');

        foreach ($extras as $extra) {
            # key 是商品的id
            # value 是待还会去的销量库存
            $ids = collect($extra['product_skus'])->pluck('count','id')->toArray();
            IncrProductStock::dispatch($ids);
        }

    }
}
