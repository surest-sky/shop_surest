<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminsTableSeeder::class);     # 创建后台管理用户
         $this->call(UsersTableSeeder::class);      # 创建会员用户
         $this->call(CategoryTableSeeder::class);     # 创建分类相关数据
         $this->call(ProductsTableSeeder::class);   # 创建商品数据
         $this->call(ImagesTableSeeder::class);     # 创建图片相关数据
         $this->call(SubscribersTableSeeder::class);     # 创建订阅用户相关数据
         $this->call(WishTableSeeder::class); # 创建收藏列表数据
         $this->call(BannerTableSeeder::class); # 创建收藏列表数据
    }
}
