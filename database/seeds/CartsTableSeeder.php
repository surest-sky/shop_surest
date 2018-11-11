<?php

use Illuminate\Database\Seeder;
use App\Models\ProductSku;
use App\Models\User;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $skus = ProductSku::all()->pluck('id')->toArray();

        $uids = User::all()->pluck('id')->toArray();

        $arr = $this->getCon($uids,$faker,$skus);

        \DB::table('carts')->insert($arr);

        $arr = $this->getCon($uids,$faker,$skus);

        \DB::table('carts')->insert($arr);

    }

    protected function getCon ($uids,$faker,$skus) {

        $len = count($uids);

        $arr = [];

        for ($i=0; $i<$len; $i++){
            $arr[$i]['product_sku_id'] = $faker->randomElement($skus);
            $arr[$i]['user_id'] = $faker->randomElement($uids);
            $arr[$i]['amount'] = random_int(2,99);
        }

        return $arr;
    }
}
