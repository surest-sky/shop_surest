<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Redis\LoginCache;

class Actived
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        # 记录活跃用户 && 用户登录
        $user = Auth::user();

        if( $user ) {
            # 记录最近的登录信息
            if ( $now = LoginCache::setLoginAt($user->id) ) {

                # 给予用户登录的日活跃分数
                event(new \App\Events\ActiveUser($user->id,2));

                $user->login_at = $now;
                $user->save();
            }


        }

        return $next($request);
    }
}
