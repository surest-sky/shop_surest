<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Traits\UserHandlerTrait;

class User extends Authenticatable
{
    // 有关于suer处理的相关操作
    use UserHandlerTrait;

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
        'name', 'email', 'password','avatar','phone','w_id','q_id','x_id','active','salt'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function getUserInfo($val,$field)
    {
        if( !$field ) {
            $field = checkParamType($val);
        }
        $user = self::where($field,$val)->first();

        return $user;
    }
}
