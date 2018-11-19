<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\ProductOberver;
use App\Models\Product;
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
        Product::observe(ProductOberver::class);
        \Debugbar::enable();


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
            $config['notify_url'] = 'http://requestbin.leo108.com/1drdi441'; #route('pay.alipay.notify');
            # curl -X POST http://shop.surest.cn/alipay/notify -d

            return Pay::alipay($config);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
