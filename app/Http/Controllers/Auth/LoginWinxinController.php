<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Boolean;
use Socialite;
use App\Models\User;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Facades\Redis;

class LoginWinxinController extends Controller
{
    protected $key = 'wxInfo';

    protected $state;

    public function login(Request $request)
    {
        if( $request->key && ($openid = $this->setAndGetUser($request->key))){
            # 数据库查询用户是否存在
            $user = User::where(User::FIELD['weixin'] , $openid)->first();
            if( $user ) {
                \Auth::login($user,true);
                return redirect()->route('index');
            }else{
                return view('error.show',['msg' => '用户未找到']);
            }
        }

        dd($request->all());
        return view('error.show',['msg' => '非法操作哦']);
    }

    public function getCodeAndState()
    {
        $stateCode = $this->state = userId();

        $codeUri = route('wx.code',['uid' => $stateCode]);

        return response()->json(compact('codeUri','stateCode'),200);
    }
    
    /**
     *  渲染生成二维码
     *  uri 为发起用户授权
     *  https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140842
     */
    public function getCode(Request $request)
    {
        # 获取一张这个验证码的标识符
        $state = $request->uid;

        $uri = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0c2ebfe7751517da&redirect_uri='. route('wx.store') .'&response_type=code&scope=snsapi_userinfo&state='. $state .'#wechat_redirect';
        $qrCode = new QrCode($uri);
        return response( $qrCode->writeString() , 200 , [ 'Content-Type' => $qrCode->getContentType() ]);
    }

    /**
     * 登录处理逻辑
     * 把不管是成功信息 或者 失败信息 都存入Redis缓存中
     * $key 'wxInfo'
     * [
     *   'success 或则 error' = [
     *         所有的信息
     *      ],
     *    status => '200' 或则 '400'
     * ]
     * @param Request $request
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function loginStore(Request $request)
    {
        $state = $request->state;

        if( !$code = $request->code ) {
            $this->writeError('身份验证失败',$state);
            return '身份验证失败咯，请扫码重试';
        }
        $getIdUri = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx0c2ebfe7751517da&secret=3a915dac3b173cda2cc5bd67e7655083&code=' . $code . '&grant_type=authorization_code';

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET',$getIdUri);

        # 获取到的参数包括openid参数信息
        # https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140842
        $content = json_decode( $res->getBody() ,true);

        if(  isset($content['errcode'])  ){
            $this->writeError('身份验证失败',$state);
            return '身份验证失败咯，请扫码重试';
        }

        $access_token = $content['access_token'];
        $open_id = $content['openid'];

        $getInfoUri = sprintf('https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN',$access_token,$open_id);

        $res = $client->request('GET' , $getInfoUri );

        $content = json_decode( $res->getBody() , true );

        $this->writeSuccess($content,$state);

        echo '登陆成功 ... 微信页面内请手动返回';
    }

    /**
     * 这里成功返回的信息是json格式的
     * 在控制器中需要将其解析为数组
     * @param $info string
     */
    public function writeSuccess($info,$state)
    {
        $result = [
            'info' => $info,
            'status' => 200
        ];

        $result = call_user_func('serialize' , $result ) ;

        Redis::hset( $this->key , $state , $result );

        $this->setExireat();
    }

    /**
     * @param $info string 只需要传递一个错误信息即可
     * 例 ： '默认是身份验证失败'
     */
    public function writeError($info,$state)
    {
        $result = [
            'info' => $info,
            'status' => 400
        ];

        $result = call_user_func('serialize' , $result ) ;

        Redis::hset( $this->key , $state , $result );
        $this->setExireat();
    }


    /**
     * 设置过期时间
     */
    public function setExireat()
    {
        Redis::EXPIRE( $this->key , \Carbon\Carbon::now()->addMinutes(10)->timestamp );
    }

    /**
     * 前端不断轮询这个方法
     * 读取验证信息
     */
    public function readWxInfo(Request $request)
    {
        $result = Redis::hget( $this->key , $request->state);

        if( !$result || empty($result) ){
            return response()->json('登陆中',404);
        }

        $result = call_user_func('unserialize' , $result );

        # 判断数据是否正确
        if( $result['status'] == 200 ) {

            $userInfo = $result['info'];

            # 执行登陆逻辑
            $res =  User::kindStore($userInfo['openid'],'weixin',$userInfo,true);

            if( $res ) {
                # 给前端发送一个openid+time的key
                $key = $this->setAndGetUser($result['info']['openid'],false);
                return response( compact('key') ,200);
            }
        }

        # 返回错误
        return response($result['info'],200);
    }

    /**
     * @param $isOk boolean
     * true 时 解析获取openid数据
     * false 时 设置获取openid数据
     */
    public function setAndGetUser($parm, bool $isOk=true)
    {
        $cCkey = 'uid';
        # 获取数据
        if( $isOk ) {

            $res = Redis::hget($cCkey , $parm );

            if( $res && !empty($res) ) {
                return $res;
            }
                return false;
        }else{
            $key = userId();
            Redis::hset($cCkey , $key ,  $parm);
            return $key;
        }
    }
}






