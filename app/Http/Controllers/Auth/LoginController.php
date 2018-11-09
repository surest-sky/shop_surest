<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\HttpException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\LoginRequest;


class LoginController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public static function store(LoginRequest $request)
    {
        $name = $request->name;
        $password = $request->password;
        $field = checkParamType($name) ? checkParamType($name) : 'name' ;

        if( !$user = User::getUserInfo($name,$field) ) {
            session()->flash('status','用户不存在');
            return redirect()->back();
        }
        if( !$user = User::checkPassword($user,$password) ){
            session()->flash('status','密码错误');
            return redirect()->back();
        }

        \Auth::login($user,true);

        return redirect('/');
    }

    /**
     * 注销
     */
    public function logout(Request $request)
    {
        $id = $request->id;

        if( !$id || ($id != \Auth::user()->id ) ) {
            throw new HttpException();
        }

        \Auth::logout();

        return redirect()->back();
    }


}
