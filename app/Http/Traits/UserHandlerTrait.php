<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/5
 * Time: 11:12
 */

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Exceptions\SysException;

trait UserHandlerTrait
{
    /**
     * 密码校验
     * @param $user
     * @param $pwd
     * @return bool
     */
    public static function checkPassword($user, $pwd)
    {
        if( $user->password === eny($pwd,$user->salt)) {
            return $user;
        }
        return false;
    }

    /**
     * 第三方登录操作
     * @param $uid integer 微博的唯一id
     * @param $type string 字段
     * @param $userInfo
     */
    public static function kindStore($uid,$type,$userInfo)
    {
        $field = User::FIELD[$type];

        // 查询数据库中是否有这个用户
        $user = User::getUserInfo($uid,$field);

        if( !$user || empty($user) ) {
            new Registered($user= self::createUser($userInfo,$field));
        }

        Auth::login($user,true);

        return redirect()->route('index');
    }


    /**
     * 为第三方登录创建一个用户
     * @param $userInfo array 用户的信息类 必须包含的值： 用户名 - 第三方登录uid
     * @param $field string 即将写入的字段
     * @return mixed
     */
    public static function createUser($userInfo,$field)
    {
        switch ($field) {
            case User::FIELD['weibo']:
                return self::WeiBoHandler($userInfo,$field);
                break;
        }

    }

    public static function WeiBoHandler($userInfo,$field){
        try{
            DB::beginTransaction();
            $arr = [
                'name' => $userInfo['name'],
                $field => $userInfo['id'],
                'avatar' => $userInfo['avatar_hd'] ?? 'https://laravel-china.org/users/5758',
                'actived' => '1',
                'type' => User::TYPE_WEIBO
            ];
            DB::commit();

            return $user = User::create($arr);
            return $user;
        }catch (\Exception $e){
            DB::rollback();
            throw new SysException([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * 从缓存中获取登录字段信息
     * 将获取到的验证码值 和 缓存key取出的数据进行对比
     * @param $key string 缓存key
     * @param $code string 验证码
     * @return bool
     * @throws \Exception
     */
    public static function getAccount($key,$code)
    {
        $result = cache($key);
        if( !$result ) {
            return false;
        }

        if( $code != $result['code'] ) {
            return false;
        }

        return $result['account'];
    }
}