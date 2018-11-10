<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\Image;
use Faker\Factory;

class productImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $pIds = Product::all()->pluck('id')->toArray();
        $pSkusIds = ProductSku::all()->pluck('id')->toArray();

        $images = [
            'http://shop.surest.cn/assets/images/products/product_01.jpg',
            'http://shop.surest.cn/assets/images/products/product_02.jpg',
            'http://shop.surest.cn/assets/images/products/product_03.jpg',
            'http://shop.surest.cn/assets/images/products/product_04.jpg',
            'http://shop.surest.cn/assets/images/products/product_05.jpg',
            'http://shop.surest.cn/assets/images/products/product_06.jpg',
            'http://shop.surest.cn/assets/images/products/thumb_01.jpg',
            'http://shop.surest.cn/assets/images/products/thumb_02.jpg',
            'http://shop.surest.cn/assets/images/products/thumb_03.jpg',
            'http://shop.surest.cn/assets/images/products/thumb_04.jpg',
            'http://shop.surest.cn/assets/images/products/thumb_05.jpg',
            'http://shop.surest.cn/assets/images/products/thumb_06.jpg'
        ];
        $count = count($pIds);
        $arr = [];
        for ($i=0; $i<$count; $i++){
            $arr[$i] = [
                'product_id' => $pIds[$i],
                'src' => $faker->randomElement($images)
            ];
        }
        \DB::table('images')->insert($arr);

        $count = count($pSkusIds);
        $arr = [];
        for ($i=0; $i<$count; $i++){
            $arr[$i] = [
                'product_sku_id' => $pSkusIds[$i],
                'src' => $faker->randomElement($images)
            ];
        }
        \DB::table('images')->insert($arr);
    }
}
