<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = array_values(getRouteList()->all());;

        $i = 0;

        $arr = [
            [
                'name' => '首页-',
                'description' => '首页--',
                'route' => $lists[0]
            ],
            [
                'name' => '用户管理-',
                'description' => '用户管理--',
                'route' => $lists[1]
            ],
            [
                'name' => '会员管理-',
                'description' => '会员管理--',
                'route' => $lists[2]
            ],
            [
                'name' => '分类管理-',
                'description' => '分类管理--',
                'route' => $lists[3]
            ],
            [
                'name' => '商品管理-',
                'description' => '商品管理--',
                'route' => $lists[4]
            ],
            [
                'name' => '上传管理-',
                'description' => '上传管理-',
                'route' => $lists[5]
            ],
            [
                'name' => '轮播管理-',
                'description' => '轮播管理--',
                'route' => $lists[6]
            ],
            [
                'name' => '订单管理-',
                'description' => '订单管理--',
                'route' => $lists[7]
            ],
            [
                'name' => '快递管理-',
                'description' => '快递管理--',
                'route' => $lists[8]
            ],
        ];

        foreach ($arr as $v) {
            \App\Models\Permission::create($v);
        };
    }
}
