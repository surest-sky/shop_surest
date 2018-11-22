<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;

class LoginQqController extends Controller
{
    public function loginToRedirect()
    {
        return Socialite::driver('qq')->redirect();
    }

    public function login()
    {
        $user = Socialite::driver('qq')->user();

        $uid = $user->id;

        // 执行登录操作
        return User::kindStore($uid,'qq',$user);
    }
}
