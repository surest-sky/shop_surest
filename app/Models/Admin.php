<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;

    use Notifiable;

    protected $fillable = [
        'name' , 'password', 'salt','actived','avatar'
    ];

    public $guard_name  = 'admin';

    protected $hidden = [
        'password' , 'remember_token','salt'
    ];

    const total = 5;
    /**
     * 获取所有用户
     * @param $bol boolean 是否正序
     */
    public static function getByUserAll($page=true,$timeData=[])
    {
        $type = true ? 'DESC' : 'ASC';
        if( empty($timeData) ) {
            if( $page ) {
                $users = self::getPageUser(self::total);
            }else{
                $users = self::getAllUser();
            }
        }else{
            $users = self::getTimeUserAll($timeData);
        }

        return $users;
    }

    /**
     * 获取所有的权限
     */
    public static function getPermissionAll()
    {
        return \DB::table('permissions')->where('guard_name','admin')->get();
    }

    /**
     *
     * @param $total
     * @return mixed
     */
    public static function getPageUser($total)
    {
        return self::orderBy('created_at','DESC')->paginate($total);
    }


    public static function getAllUser()
    {
        return self::orderBy('created_at','DESC')->get();
    }

    public static function getTimeUserAll($timeData)
    {

    }

    public function getPhoneAttribute($value)
    {
        if( !$value ) {
            return '未设置';
        }
        return $value;
    }

    public function getEmailAttribute($value)
    {
        if( !$value ) {
            return '未设置';
        }
        return $value;
    }

    public function getSimpleRolesAttribute()
    {
        $roles = $this->getRoleNames();
        return $roles;
    }

}
