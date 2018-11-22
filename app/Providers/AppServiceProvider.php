<?php

namespace App\Providers;

use App\Models\Address;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wish;
use App\Observers\AddressObserver;
use App\Observers\BannerObserver;
use App\Observers\CartObserver;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;
use App\Observers\WishObserver;
use Illuminate\Support\ServiceProvider;
use Monolog\Logger;
use Yansongda\Pay\Pay;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ProductObserver::class);
        Cart::observe(CartObserver::class);
        Wish::observe(WishObserver::class);
        Order::observe(OrderObserver::class);
        Address::observe(AddressObserver::class);
        Banner::observe(BannerObserver::class);
        Address::observe(AddressObserver::class);
        \Debugbar::disable();


        # 向容器中注入一个容器
        $this->app->singleton('alipay',function (){
            $config = config('pay.alipay');
            if (app()->environment() !== 'production') {
                $config['mode']         = 'dev';
                $config['log']['level'] = Logger::DEBUG;
            } else {
                $config['log']['level'] = Logger::WARNING;
            }

            $config['return_url'] = route('pay.alipay.return');
            $config['notify_url'] = return_notify_url('alipay');

            return Pay::alipay($config);
        });

        # 向容器中注入一个容器
        $this->app->singleton('wechat',function (){

            $config = config('pay.wechat');

            if (app()->environment() !== 'production') {
                $config['log']['level'] = Logger::DEBUG;
            } else {
                $config['log']['level'] = Logger::WARNING;
            }
            $config['notify_url'] = return_notify_url('wechat');

            // 调用 Yansongda\Pay 来创建一个微信支付对象
            return Pay::wechat($config);
        });

    }
}
