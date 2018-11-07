<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/7
 * Time: 18:46
 */

namespace App\Services;


class CommonService
{
    public static function setParams($request,$admin)
    {
        if( !$admin || $request->password != $admin->password ){
            $salt = setCode(5);
            $password = eny($request->password,$salt);
        }else{
            $salt = $admin->salt;
            $password = $request->password;
        }
        $params = [
            'name' => $request->name,
            'password' => $password,
            'salt' => $salt,
            'actived' => '1', // 默认激活
        ];
        return $params;
    }

    public static function userSetParams($request,$user=false)
    {
        if( !$user || $request->password != $user->password ){
            $salt = setCode(5);
            $password = eny($request->password,$salt);
        }else{
            $salt = $user->salt;
            $password = $request->password;
        }
        $params = [
            'name' => $request->name,
            'password' => $password,
            'salt' => $salt,
            'actived' => '1', // 默认激活
            'email' => $request->email,
            'phone' => $request->phone,
            'avatar' => config('main.avatar') ?? ''
        ];
        return $params;
    }
}