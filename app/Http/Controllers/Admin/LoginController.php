<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/5
 * Time: 19:29
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminLoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/login';

    public function login()
    {
        return view('admin.login');
    }

    public function __construct()
    {
        $this->middleware('guest.admin', ['except' => 'logout']);
    }

    protected function guard()
    {
       return auth()->guard('admin');
    }

    public function username()
    {
        return 'name';
    }

    public function store(AdminLoginRequest $request)
    {

        $user = Admin::where('name',$request->name)->first();

        if( $user ) {
            if( $user->name == config('main.admin') || $user->actived) {
                $password = eny($request->password, $user->salt);
                if ($password == $user->password) {
                    // 登录成功
                    \Auth::guard('admin')->login($user);
                }
            }else{
                session()->flash('status','您的账号已经被封停');
                return redirect()->back();
            }
        }
        session()->flash('status','用户不存在或者密码错误');
        return redirect()->back();
    }

}