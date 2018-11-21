<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\ProductSku;

class IncrProductStock implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 2;

    protected $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        # key 是商品的id
        # value 是待还会去的销量库存
        $extra = $this->order->extra;

        $ids = collect($extra['product_skus'])->pluck('count','id')->toArray();

        # key 代表商品sku - id
        # value 代表库存

        foreach ($ids as $key=>$value) {
            $product = ProductSku::where('id',$key)->select('id')->first();
            $product->increment('stock',$value);
        }
    }
}
