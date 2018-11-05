<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/3
 * Time: 9:55
 */

namespace App\Http\Controllers\Auth;

use App\Http\Traits\LoginWeiboHandler;
use Illuminate\Http\Request;
use App\Models\User;

class LoginWeiboController extends BaseController
{
    use LoginWeiboHandler;

    /**
     * 微博登录
     * 调起微博登录 - 获取code - 携带code请求accessToken - 携带token获取用户信息
     */
    public function login(Request $request)
    {
        $code = $request->code;

        if (!$code) {
            return $this->getCode();
        }
        $result = $this->setGetWbAccessToken($code);
        $access_token = $result['access_token'];
        $uid = $result['uid'];
        return $this->user($access_token,$uid);
        // 获取用户信息

    }

    public function user($access_token,$uid)
    {
        $userInfo = $this->getUserInfo($access_token,$uid);
        // 执行登录操作
        return User::kindStore($uid,'weibo',$userInfo);
    }

}