<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/21
 * Time: 20:32
 */

namespace App\Observers;

use App\Models\Order;
use App\Models\Product;

class OrderObserver
{
    public function saved(Order $order)
    {
        $productSkus = $order->extra;
        $skus = $productSkus['product_skus'];

        # 重新写缓存
        Product::setPartByCacheProduct($skus);
    }
}