<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/17
 * Time: 23:28
 */

namespace App\Handle;


class ActiveUserHandler
{
    # 活跃用户的处理

    # 权重计算 偶数
    # 创建订单 + 4
    # 完成订单 + 10
    # 评论商品 + 2
    # 浏览商品 + 1
    # 订阅我们 + 6
    # 保持每天登陆 递增 1 2 3 4 5 6 7 8 9 10(封顶计算)


}