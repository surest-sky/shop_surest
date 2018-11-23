<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/1
 * Time: 21:21
 */

/**
 * 获取静态文件的地址
 * @return string
 */
function getAssets() {
    return config('APP_URL') . config('mian.assets');
}

/**
 * 返回登录的字段类型
 *
 * @param $value
 * @return bool|mixed|string
 */
function checkParamType($value) {
    if( filter_var($value,FILTER_VALIDATE_EMAIL) ) {
        return 'email';
    }

    $res = filter_var($value,FILTER_CALLBACK,[
        'options' => function ($value){
            if( preg_match('/^1[34578]\d{9}$/',$value) ) {
                return 'phone';
            }
        }
    ]);

    return is_null($res) ? false : $res;
}
function setCode($num)
{
    $i = 0;
    $code = '';
    while ($i<$num) {
        $code .= random_int(0,9);
        $i++;
    }
    return $code;
}

function eny($pwd,$salt){
    return md5($salt . md5($pwd));
}

function setResponse($msg,$status){
    $res = config('response');
    $res['msg'] = $msg;
    $res['status'] = $status;
    return $res;
}

function getRouteList(){
    $app = app();
    $routes = $app->routes->getRoutes();
    $list = [];
    foreach ($routes as $k=>$value){
        array_push($list,$value->uri);
    }
    $len = count($list);
    $arr = [];
    for ($i=0; $i<$len; $i++ ) {
        if( preg_match('#admin/[a-z]+#',$list[$i])){
            preg_match_all('#admin/[a-z]+#',$list[$i],$match);
            array_push($arr,$match[0][0]);
        }
    }
    $list = array_unique($arr);
    array_push($list,'*');
    return collect($list);
}

function checkAddress($val) {
    $parttrn = '#(.*)?[/-](.*)?[-/](.*)?#';
    preg_match_all($parttrn, $val, $match);
    if( empty($match[3]) ) {
        return false;
    }

    return $match;
}

function orderNo() {
    $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
    $orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
    return $orderSn;
}

function rand_avatar() {

    # 随机生成一个8-10位的qq号码
    $i = 2;
    $str = '1';

    while ($i<10) {
        $str .= mt_rand(1,10);
        $i++;
    }
    $str = sprintf('http://q1.qlogo.cn/g?b=qq&nk=%d&s=640',$str);
    return $str;
}


# 定制化支付回调
function return_notify_url($pay_method='') {
    switch ($pay_method){
        case 'wechat' :
            return App()->environment('production') ? route('pay.wechat.notify')  : 'http://requestbin.leo108.com/1h5v1451';
            break;
        case 'alipay' :
            return App()->environment('production') ? route('pay.alipay.notify') : "http://requestbin.leo108.com/1h5v1451"; // 验证是否请求正确
            break;
        default :
            return App()->environment('production') ? route('pay.wechat.refund') : "http://requestbin.leo108.com/1h5v1451";  // 退款
    }
}