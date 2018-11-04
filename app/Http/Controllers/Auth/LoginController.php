<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\HttpException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;


class LoginController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public static function store($uid,$type)
    {


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
