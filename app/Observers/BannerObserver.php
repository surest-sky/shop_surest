<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/22
 * Time: 0:13
 */

namespace App\Observers;

use App\Models\Banner;

class BannerObserver
{
    public function deleted(Banner $banner)
    {
        Banner::setRedisBanner();
    }

    public function created(Banner $banner)
    {
        Banner::setRedisBanner();
    }
}