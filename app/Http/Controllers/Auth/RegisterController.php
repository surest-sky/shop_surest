<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/3
 * Time: 22:26
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }


    /**
     * 处理登录逻辑
     */
    public function store()
    {

    }

    public function account(RegisterRequest $request)
    {
        dd($request->all());
    }
}