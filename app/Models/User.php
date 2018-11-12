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

    /**
     * 关联的愿望清单
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wishes()
    {
        return $this->hasOne(Wish::class,'user_id','id');
    }

    public function getWishCountAttribute()
    {
        $ids = $this->wishes->product_ids;
        $ids = json_decode($ids,true);
        return count($ids);
    }

    /**
     * 用户的购物车
     */
    public function carts()
    {
        return $this->hasMany(Cart::class,'user_id','id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id','id');
    }

    public static function getUserInfo($val,$field)
    {
        if( !$field ) {
            $field = checkParamType($val);
        }

        $user = self::where($field,$val)->first();

        return $user;
    }

    /**
     * 获取所有的用户信息
     * @param $bol boolean 是否倒叙
     */
    public static function getUserAll($bol = true)
    {
        $type = $bol ? 'DESC' : 'ASC';
        $users = self::query()->orderBy('created_at','DESC')->get();
        return $users;
    }

    
}
