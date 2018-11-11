<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/5
 * Time: 10:22
 */

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterAccountRequest;
use App\Models\User;
use App\Services\SendSmsHandleService;
use Validator;
use App\Exceptions\LoginException;
use App\Handle\SetCacheHandler;

class ForgetController extends BaseController
{
    public function forget()
    {
        return view('auth.forget');
    }

    /**
     * 第一步：
     * 请求手机或者邮箱验证码并缓存数据
     * @param RegisterAccountRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function account(RegisterAccountRequest $request)
    {
        $account = $request->account;
        $type = checkParamType($account);
        $user = User::getUserInfo($account,$type);
        if( !$user ) {
            return response()->json([
                'errors' => '该用户不存在'
            ],401);
        }
        $sms = new SendSmsHandleService();
        $con = $sms->handler($account,$type);

        $res = [
            'key' => $con['key']
        ];

        return response()->json($res,200);
    }

    /**
     * 第二步：
     * 传递过来的数据，准备进入填写密码页面
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws LoginException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'key' => 'required',
            'captcha' => 'required'
        ],[
            'key.required' => '验证码已失效',
            'captcha.required' => '请填写验证码'
        ]);
        if ($validator->fails()) {
            return redirect('/forget')
                ->withErrors($validator)
                ->withInput();
        }
        $key = $request->key;
        $code = $request->captcha;
        if( !$account = User::getAccount($key,$code) ){
            session()->flash('status','验证码错误或者失效');
            session()->flash('key',$key);
            return redirect()->back();
        }

        $user = User::getUserInfo($account,false);

        if( $user ) {
            $key = SetCacheHandler::setCache($user->id);
            return redirect()->route('forget_too',['key' => $key]);
        }
            throw new LoginException([
                'message' => '非法操作'
            ]);
    }

    /***
     * 处理密码逻辑，写入数据库
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store_pwd(Request $request)
    {
        if( !$key = $request->key ) {
            return $this->session_flash('时间过长已经失效');
        }
        $validator = Validator::make($request->all(),[
            'password' => 'required|between:6,16|confirmed',
        ],[
            'password.required' => '密码不能为空'
        ]);
        if ($validator->fails()) {
            return redirect('/forget_too/'.$key)
                ->withErrors($validator)
                ->withInput();
        }

        if( !$key || !$val = SetCacheHandler::getCache($key) ) {
            return $this->session_flash('时间过长已经失效');
        }

        $user = User::find($val);

        $user->password = eny($request->password,$user->salt);
        $user->save();

        session()->flash('status','修改成功');

        return redirect()->route('login');

    }

    /**
     * 渲染确认密码页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function forget_too(Request $request)
    {
        if( !$key = $request->key ) {
            return $this->session_flash('时间过长已经失效');
        }
        return view('auth.forget_too',['key'=>$key]);
    }

    /**
     * @param $msg
     * @return \Illuminate\Http\RedirectResponse
     */
    public function session_flash($msg)
    {
        session()->flash('status',$msg);
        return redirect()->route('forget');
    }
}