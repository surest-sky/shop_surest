<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/17
 * Time: 2:16
 */

namespace App\Handle;


class ExpressHandler
{

    /**
     * 快递查询
     * @param $ship_cpy
     * @param $ship_code
     */
    public function getOrderTracesByJson($ship_cpy,$ship_code)
    {
        $requestData= "{'OrderCode':'','ShipperCode':'{$ship_cpy}','LogisticCode':'{$ship_code}'}";

        $datas = array(
            'EBusinessID' => config('express.EBusinessID'),
            'RequestType' => '1002',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, config('express.AppKey'));

        $result = $this->sendPost(config('express.ReqURL'), $datas);

        //根据公司业务处理返回的信息......

        $result = json_decode($result,true);

        return $result['Traces'];
    }

    /**
     *  post提交数据
     * @param  string $url 请求Url
     * @param  array $datas 提交的数据
     * @return url响应返回的html
     */
    public function sendPost($url, $datas) {

        $temps = array();
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if(empty($url_info['port']))
        {
            $url_info['port']=80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader.= "Host:" . $url_info['host'] . "\r\n";
        $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader.= "Connection:close\r\n\r\n";
        $httpheader.= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets.= fread($fd, 128);
        }
        fclose($fd);

        return $gets;
    }

    /**
     * 电商Sign签名生成
     * @param string data 内容
     * @param string appkey Appkey
     * @return string  DataSign签名
     */
    public function encrypt($data, $appkey) {
        return urlencode(base64_encode(md5($data.$appkey)));
    }
}