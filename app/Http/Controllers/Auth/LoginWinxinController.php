<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;

class LoginWinxinController extends Controller
{
    public function loginToRedirect()
    {
        return Socialite::driver('weixin')->redirect();
    }

    public function login()
    {
        $user = Socialite::driver('weixin')->user();

        $uid = $user->id;

        // 执行登录操作
        return User::kindStore($uid,'weixin',$user);
    }
}
