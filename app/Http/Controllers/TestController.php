<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function sub()
    {
        $products = \App\Models\Product::getSubscription(5);
        return view('emails.sub.list', compact('products'));
    }

    public function form()
    {
        return view('test.show');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     *  二维码测试
     */
    public function qcode()
    {
        $uri = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0c2ebfe7751517da&redirect_uri='. route('qcodeStore') .'&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect';
        $qrCode = new QrCode($uri);
        header('Content-Type',$qrCode->getContentType());
        echo $qrCode->writeString();
    }

    public function show()
    {
        return view('test.show');
    }
    public function qcodeStore(Request $request)
    {
        if( !$code = $request->code ) {
            return '身份验证失败';
        }
        $getIdUri_ = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx0c2ebfe7751517da&secret=3a915dac3b173cda2cc5bd67e7655083&code=' . $code . '&grant_type=authorization_code';

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET',$getIdUri_);

        # 获取到的参数包括openid参数信息
        # https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140842
        $content = json_decode( $res->getBody() ,true);

        if(  isset($content['errcode'])  ){
            return '身份验证失败';
        }

        $access_token = $content['access_token'];
        $open_id = $content['openid'];

        $getInfoUri = sprintf('https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN',$access_token,$open_id);

        $res = $client->request('GET' , $getInfoUri );

        $content = json_decode( $res->getBody() , true );

        dd($content);
    }
}
