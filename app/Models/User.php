<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Auth;

class User extends Authenticatable
{
    use Notifiable;
    const TYPE_WEIBO = 'weibo';
    const TYPE_QQ = 'qq';
    const TYPE_WECHAT = 'weixin';
    const FIELD = [
        self::TYPE_WEIBO => 'w_id',
        self::TYPE_QQ => 'q_id',
        self::TYPE_WECHAT => 'x_id',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','phone','w_id','q_id','x_id','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function getUserInfo($uid,$field)
    {
        $user = self::where($field,$uid)->first();

        return $user;
    }




}
