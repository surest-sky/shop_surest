<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/18
 * Time: 13:17
 */

namespace App\Http\Traits;

use App\Models\User;

trait UserAdminTrait
{
    /**
     * 获取所有的商品数据
     * @param bool $page true = 分页数据获取 false = 获取全部数据
     * @return Product[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection|mixed|string|void
     */
    public static function getUsersAll($page=true)
    {
        if( $page ) {
            $users = self::getPageUser();
        }else{
            $users = self::getAllUser();
        }
        return $users;
    }

    /**
     * 后台管理模块
     * 分页数据获取商品数据
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getPageUser()
    {
        $users = self::query()->orderBy('created_at','DESC')
            ->paginate(10);

        return $users;
    }

    public static function getAllUser()
    {
       return User::all();
    }
}