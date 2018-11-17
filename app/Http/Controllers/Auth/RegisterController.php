<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/3
 * Time: 22:26
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAccountRequest;
use App\Services\SendSmsHandleService;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Exceptions\SysException;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }


    /**
     * 处理注册逻辑
     */
    public function store(RegisterRequest $request)
    {
        $key = $request->key;
        $captcha = $request->captcha;
        $name = $request->name;
        $password = $request->password;
        if( !$account = User::getAccount($key,$captcha) ){
            session()->flash('verify','验证码错误');
            session()->flash('key',$key);
            session()->flash('name',$name);
            return redirect()->back();
        }
        $salt = setCode(5);
        $type = checkParamType($account);
        $info = [
            'name' => $name,
            $type => $account,
            'l_pwd' => $password,
            'password' => eny($password,$salt),
            'avatar' => 'http://surest.cn/index/imgs/logo.png',
            'salt' => $salt
        ];

        try{
            $user = User::create($info);
        }catch (\Exception $e) {
            throw new SysException([
                'message' => $e->getMessage()
            ]);
        }

        session()->flash('status','注册成功');

        return redirect()->route('login');

    }


    /**
     * 请求登录接口，获取相关验证码缓存key
     * @param RegisterAccountRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function account(RegisterAccountRequest $request)
    {
        $account = $request->account;
        $type = checkParamType($account);
        $user = User::getUserInfo($account,$type);

        if( $user ) {
            return response()->json([
                'errors' => '该手机号码或者邮箱已经被注册'
            ],401);
        }
        $sms = new SendSmsHandleService();

        # 发送邮箱或者手机验证码短信
        $con = $sms->handler($account,$type);

        $res = [
            'key' => $con['key'],
            'msg' => '发送成功',
        ];

        return response()->json($res,200);
    }



}