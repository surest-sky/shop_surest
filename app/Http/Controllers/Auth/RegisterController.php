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
use App\Services\SendSmsHandleService;

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
        $account = $request->account;
        $type = checkParamType($account);
        $sms = new SendSmsHandleService();

        $res = $sms->handler($account,$type);

        return response()->json($res,200);

    }
}