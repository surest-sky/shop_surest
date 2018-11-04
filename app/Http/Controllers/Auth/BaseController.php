<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/3
 * Time: 21:30
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{

    /**
     * 登录操作
     * @param $uid
     * @param $type
     * @param $userInfo
     */
    public function store($uid,$type,$userInfo)
    {
        $field = User::FIELD[$type];

        // 查询数据库中是否有这个用户
        $user = User::getUserInfo($uid,$field);

        if( empty($user) ) {
            new Registered($user=$this->create($userInfo,$field));
        }

        Auth::login($user);
        
        return redirect()->route('index');
    }

    /**
     * 创建一个用户
     * @param $userInfo
     * @param $field
     * @return mixed
     */
    public function create($userInfo,$field)
    {
        try{
            DB::beginTransaction();
            $arr = [
                'name' => $userInfo['name'],
                $field => $userInfo['id'],
                'avatar' => $userInfo['avatar_hd'] ?? 'https://laravel-china.org/users/5758',
                'active' => '1',
            ];

           $user = User::create($arr);
           DB::commit();
           return $user;
        }catch (\Exception $e){
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function checkActive()
    {
        
    }


}