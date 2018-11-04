<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/1
 * Time: 22:19
 */

namespace App\Http\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Exceptions\LoginException;

/**
 * 处理微博登录逻辑
 * Class LoginWeiboHandler
 * @package App\Http\Traits
 */
trait LoginWeiboHandler
{
    private $key;
    private $secret;
    private $getCodeUrl;
    private $getAccessTokenUrl;
    private $host;
    private $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->key = config('login.weibo.w_key');
        $this->secret = config('login.weibo.w_secret');
        $this->getCodeUrl = config('login.weibo.w_get_code_url');
        $this->getAccessTokenUrl = config('login.weibo.w_get_access_token_url');
        $this->host = route('login.weibo');
    }

    /**
     * 设置 获取 code的url
     * @return string
     */
    public function setWbCodeUrl()
    {
        $url = sprintf($this->getCodeUrl,$this->key,$this->host);
        return $url;
    }

    /**
     * @param $code string 授权后取得的code值
     */
    public function setGetWbAccessToken($code)
    {
        if( !$code ) {
            throw new LoginException([
                'message' => '请重新登录，CODE不存在'
            ]);
        }
        $url = sprintf($this->getAccessTokenUrl,$this->key,$this->secret,$this->host,$code);
        try{
            $res = $this->client->request('POST',$url)->getBody();
        }catch (ClientException $e){
            // 处理错误
            throw new LoginException([
                'message' => '请重新登录，code失效了'
            ]);
        }
        return json_decode($res,true);
    }

    /**
     * 获取code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getCode()
    {
        $getCodeUrl = $this->setWbCodeUrl();
        return redirect()->away($getCodeUrl);
    }

    /**
     * 获取用户信息接口
     * @param $access_token
     * @param $uid
     * @return mixed
     * @throws LoginException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUserInfo($access_token,$uid)
    {
        $arr = [
            'access_token' => $access_token,
            'uid' => $uid
        ];

        $url = config('login.weibo.w_user_url') . '?' .http_build_query($arr);
        $res = $this->client->request('GET',$url);
        try{
            $res = $this->client->request('GET',$url)->getBody();
        }catch (ClientException $e){
            // 处理错误
            throw new LoginException([
                'message' => '请求微博客户端出现问题，请选择更换登录方式'
            ]);
        }
        return json_decode($res,true);

    }
}