<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductSku;
use App\Models\Product;
use App\Models\Address;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Exceptions\OrderException;
use App\Models\Cart;
use App\Http\Traits\OrderAlipayTrait;
use App\Http\Traits\OrderHanlerTrait;
use App\Http\Traits\OrderToAdminTrait;

class Order extends Model
{
    use SoftDeletes;

    # 引入支付宝支付模块
    use OrderAlipayTrait;

    # 引入相关的订单处理模块
    use OrderHanlerTrait;

    # 引入后台处理模块
    use OrderToAdminTrait;

    const REFUND_STATUS_PENDING = 'pending';
    const REFUND_STATUS_APPLIED = 'applied';
    const REFUND_STATUS_PROCESSING = 'processing';
    const REFUND_STATUS_SUCCESS = 'success';
    const REFUND_STATUS_FAILED = 'failed';

    const SHIP_STATUS_PENDING = 'pending';
    const SHIP_STATUS_DELIVERED = 'delivered';
    const SHIP_STATUS_RECEIVED = 'received';

    const PAY_STATUS_PENDING = 'pending';
    const PAY_STATUS_PAYING = 'paying';
    const PAY_STATUS_DELIVERED = 'delivered';
    const PAY_STATUS_RECEIVED = 'received';

    public static $refundStatusMap = [
        self::REFUND_STATUS_PENDING    => '未退款',
        self::REFUND_STATUS_APPLIED    => '已申请退款',
        self::REFUND_STATUS_PROCESSING => '退款中',
        self::REFUND_STATUS_SUCCESS    => '退款成功',
        self::REFUND_STATUS_FAILED     => '退款失败',
    ];


    public static $payStatusMap = [
        self::PAY_STATUS_PENDING   => '未支付',
        self::PAY_STATUS_PAYING   => '支付中',
        self::PAY_STATUS_DELIVERED => '已支付',
        self::PAY_STATUS_RECEIVED  => '支付失败',
    ];

    public static $shipStatusMap = [
        self::SHIP_STATUS_PENDING   => '未发货',
        self::SHIP_STATUS_DELIVERED => '已发货',
        self::SHIP_STATUS_RECEIVED  => '已收货',
    ];

    public $casts = [
        'extra' => 'json',
    ];

    public $appends = [
        'refundOrStatus',
        'ShipOrStatus',
        'PayOrStatus',
        'shipOrdata'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    /**
     * 数据组装
     * @param $request
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public static function prePareData($request)
    {
        $pids = $request->pids;
        $count = $request->count;
        if( count($pids) !== count($pids) ) {
            return false;
        }
        $count = array_map('intval',$count);

        $data = array_combine($pids,$count);
        $data['address_id'] = $request->address_id;

        return $data;
    }

    /**
     * 创建一个订单
     * @param $result
     * @param $data
     * @return Order
     */
    public static function createNewOrder($result,$data)
    {
        DB::beginTransaction();
        try {

            $order = new Order();

            # 创建一个订单号
            $no = self::getOrderNo();

            # 收货地址
            $address = self::getAddress($data['address_id']);

            # 获取这个订单的所有商品信息存入extra | 并且减少库存
            $productSkus = self::getProductInfo($result,$address,$data);


            $order->no = $no;
            $order->extra = $productSkus;

            $order->total_count = $result['total_count'];
            $order->total_price = $result['total_price'];
            $order->address = $address;
            $order->expir_at = Carbon::now()->addMinutes(30); # 有效期30分钟
            $order->user_id = \Auth::id();
            $order->save();

            DB::commit();

            return $order;


        }catch (\Exception $e) {
            DB::rollback();

            new OrderException([
                'message' => '订单创建失败：no - ' . $no . $e->getMessage()
            ]);
        }
    }


    public static function getOrderNo()
    {
        do{
            $no = orderNo();
        }while(Order::where('no',$no)->count());

        return $no;
    }

    public static function getProductInfo($result,$address,$data)
    {
        $arr = [];
        $arr['address'] = $address;
        $arr['total_price'] = $result['total_price'];
        $arr['total_count'] = $result['total_count'];
        $arr['product_skus'] = [];

        # 排他锁，保持获取的库存一致
        $productSkus = ProductSku::with('product')->whereIn('id',$result['ids'])->lockForUpdate()->get();


        # 减库存
        foreach ($productSkus as $key=>$productSku) {

            # 减库存
            $productSku->decrement('stock',$data[$productSku->id]);

            $arr['product_skus'][$key]['product_id'] = $productSku->product->id;
            $arr['product_skus'][$key]['id'] = $productSku->id;
            $arr['product_skus'][$key]['name'] = $productSku->name;
            $arr['product_skus'][$key]['count'] = $data[$productSku->id];
            $arr['product_skus'][$key]['price'] = $productSku->price;
        }

        # 重新写缓存
        Product::setCacheProduct();

        # 清除购物车
        $carts = Cart::where('user_id',\Auth::id())->whereIn('product_sku_id',$result['ids'])->get()->pluck('id')->toArray();

        Cart::destroy($carts);


        return $arr;

    }

    public static function getAddress($address_id)
    {
        return Address::find($address_id)->addresses;
    }



    /**
     * data [
     *    100 => 10
     * ]
     * key = 商品id
     * value = 购买量
     *
     * 库存检查
     * @param $data
     */
    public static function checkStock($data)
    {
        $result = [
            'stock' => false, # 默认库存不足
            'total_price' => 0,
            'name' => '',
            'ids' => [],
            'total_count' => 0
        ];

        unset($data['address_id']);

        # 首先检查所有的商品数据是否有库存
        $pSkuIds = array_keys($data);

        # 待支付的商品id
        $result['ids'] = $pSkuIds;

        $pSkus = ProductSku::whereIn('id',$pSkuIds)->select('id','name','price','stock')->get();

        foreach ($pSkus as $pSku) {
            if( $pSku->stock < $data[$pSku->id] ) {
                $result['name'] = $pSku->name;
                return $result; # 库存不足
            }
            $result['total_price'] += $pSku->price * $data[$pSku->id];
            $result['total_count'] += $data[$pSku->id];
        }

        $result['stock'] = true;
        $result['total_price'] = sprintf('%.2f',$result['total_price']);
        $result['total_count'] = sprintf('%d',$result['total_count']);
        return $result;
    }



    public function getExtraAttribute($value)
    {
        return json_decode($value,true);
    }


    public function getPayOrStatusAttribute()
    {
        $value = $this->pay_status;
        return self::$payStatusMap[$value];
    }

    public function getRefundOrStatusAttribute()
    {
        $value = $this->refund_status;
        return self::$refundStatusMap[$value];
    }

    public function getShipOrStatusAttribute()
    {
        $value = $this->ship_status;
        return self::$shipStatusMap[$value];
    }

    public function getShipOrdataAttribute()
    {
        $data = explode('-',$this->ship_data);
        $company = \App\Models\Express::where('serial',$data[0])->select('name')->first()->name;
        return [
            'company' => $company,
            'no' => $data[1],
            'serial' => $data[0]
        ];

    }

    public function getStatusAttribute()
    {
        # 当支付已经关闭的时候，查看订单状态
        if( $this->closed ) {
            return $this->pay_status;
        }
        $expir = strtotime($this->expir_at) - time();

        if( $expir < 0 ) {
            return '已关闭';
        }

        $minute = floor($expir / 60);
        $second = $expir % 60;

        return '剩余：' . $minute .'分钟 - ' . $second . '秒' . ' 将关闭订单';
    }



}
