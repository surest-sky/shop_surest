<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/5
 * Time: 19:20
 */

namespace App\Http\Controllers\Admin;


class IndexController extends BaseController
{
    public function index()
    {
        $user = \Auth::guard('admin')->user();
        return view('admin.index.index', compact('user'));
    }

    public function welcome()
    {
        return view('admin.index.welcome');
    }
}