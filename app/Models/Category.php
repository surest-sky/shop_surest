<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function getCategoryAll($bol=true)
    {
        $type = $bol ? 'DESC' : 'ASC';
        $categories = self::query()->orderBy('created_at','DESC')->get();
        return $categories;
    }
    /**
     * 获取所有的用户信息
     * @param $bol boolean 是否倒叙
     */
}
