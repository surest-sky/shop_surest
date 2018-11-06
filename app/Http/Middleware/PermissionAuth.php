<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionAuth
{
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
        /**
         * 校验当前路由是否加入到权限中
         */
        if ( $permission = Permission::where('route',$route)->first() ) {
            if( !\Auth::guard('admin')->user()->hasPermissionTo($permission->name) ){
                if ($request->ajax() || $request->wantsJson()) {
                    return response(setResponse('权限不足',4003), 403);
                } else {
                    return response()->view('admin.error.403');
                }
            }
        }
        return $next($request);
    }
}