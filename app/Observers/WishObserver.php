<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/21
 * Time: 19:06
 */

namespace App\Observers;

use App\Models\Wish;

class WishObserver
{
    public function saved(Wish $wish)
    {
        Wish::setWishByUser($wish->user_id);
    }

    public function deleted(Wish $wish)
    {
        Wish::setWishByUser($wish->user_id);
    }
}