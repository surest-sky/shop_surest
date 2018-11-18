<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionAuth
{
    protected $user ;
    protected $permissions;
    protected $per_table;

    public function __construct()
    {
        $this->user = \Auth::guard('admin')->user();
    }
    /**
     * 路由权限控制
     * 针对是否可访问某路由
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = Route::current()->uri();

        # 我们需要将当前的路由过滤一遍
        $route = $this->FileRoute($route);

        if( !$this->checkPer() ){
            if ( $permission = Permission::where('route',$route)->first() ) {
                    if( !$this->user->hasPermissionTo($permission->name) ){
                        if ($request->ajax() || $request->wantsJson()) {
                            return response(setResponse('权限不足',4003), 403);
                        } else {
                            return response()->view('admin.error.403');
                        }
                    }
                }
        }
        return $next($request);
    }


    /**
     * 检查是否拥有所有权限
     * @return bool
     */
    public function checkPer()
    {
        $permissions = $this->user->getAllPermissions()->pluck('route');
        if(  $this->user->name == config('main.admin') || $permissions->contains('*') ) {
            return true;
        }
            return false;
    }

    /**
     * 将权限过滤
     * @param $route
     * @return mixed
     */
    public function FileRoute($route)
    {
        # 当前路由格式 :
        # admin/welcome
        # admin/admins/permission
        # admin/category/store

        # 我们需做出如下控制
        /**
         * admin/admins 代表第一层级权限控制
         * admin/admins/permission 代表第二层级权限控制
         */
        # 检查用户是否拥有第一层级权限，如没有，后续层级权限全部没有

        preg_match_all('#admin/[a-z]+#',$route,$match);
        return $match[0][0];

    }
}