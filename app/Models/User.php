<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Traits\UserHandlerTrait;
use App\Http\Traits\UserAdminTrait;

class User extends Authenticatable
{
    // 有关于suer处理的相关操作
    use UserHandlerTrait;

    use Notifiable;

    use UserAdminTrait;

    const TYPE_WEIBO = 'weibo';
    const TYPE_QQ = 'qq';
    const TYPE_WECHAT = 'wechat';
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
        'name', 'email', 'password','avatar','phone','w_id','q_id','x_id','active','salt','type'
    ];

    public $appends = [
        'wishCount',
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
        $wishes = \App\Models\Wish::getWishByUser(\Auth::id());
        if( !$wishes || empty($wishes) ) {
            return 0;
        }
        $count = $wishes->count();

        return $count;
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

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id' , 'id');
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

    public static function getUserDetailInfo($uid)
    {
        $user = self::where('id',$uid)->select('name','email','phone','avatar','type')->first();
        return $user;
    }

    public function getLoginsAttribute()
    {
        if( !$type = $this->type  ) {
            return null;
        }
        $type = json_decode($type,true);
        $type = collect($type) ;

        return $type;
    }

    public function address()
    {
        return $this->belongsTo(Address::class , 'user_id' , 'id');
    }

    public static function getActiveUsers($len)
    {
        $users = \App\Redis\ActiveUserCache::getActiveUser($len);
        if( !$users ) {
            return [];
        }
        $ids = array_keys($users);

        $users = [];

        # 从缓存中获取活跃用户
        foreach ($ids as $id) {
            array_push($users,\App\Redis\ActiveUserCache::getUserDetail($id));
        }

        return $users;
    }


}
