<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Requests\OrderRequest;
use App\Models\ProductSku;
use App\Models\Address;

class OrderController extends Controller
{
    /**
     * 准备订单
     * @param Request $request
     */
    public function show(OrderRequest $request)
    {
        if( !$data = Order::prePareData($request) ){
            session()->flash('status','参数错误');
            return redirect()->back();
        }

        # 创建一个订单号
        $no = $this->getOrderNo();

        # 获取这个订单的所有商品信息存入extra
        $extra = $this->getProductInfo($data);

        # 开启一个订单时间，过期时间

        dd(json_encode($extra));
        dd($data);
    }

    /**
     * 创建订单
     * @param Request $request
     */
    public function store(Request $request)
    {

    }

    public function getOrderNo()
    {
        do{
            $no = orderNo();
        }while(Order::where('no',$no)->count());

        return $no;
    }

    public function getProductInfo($data)
    {
        $arr = [];
        $arr['address'] = Address::find($data['address_id'])->addresses;
        $arr['user_id'] = \Auth::id();
        unset($data['address_id']);

        foreach ($data as $key=>$val) {
            $product = ProductSku::with(['image'])->where('id',$key)->select('id','name','price')->first()->toArray();
            $product['total_price'] = sprintf('%.2f',$product['price'] * $val);
            $product['image'] = $product['image']['src'];
            unset($product['image']);
            array_push($arr,$product);
        }
        return $arr;

    }
}
