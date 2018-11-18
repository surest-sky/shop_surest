<?php

use Illuminate\Database\Seeder;
use App\Models\ProductSku;
use App\Models\Product;
use App\Models\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skuIds = ProductSku::all()->pluck('id')->toArray();
        $productIds = Product::all()->pluck('id')->toArray();

        foreach ($skuIds as $id){
            Image::create([
                'src' => $this->getSrc(),
                'product_sku_id' => $id
            ]);
        }
        foreach ($productIds as $id){
            Image::create([
                'src' => $this->getSrc(),
                'product_id' => $id
            ]);
        }
    }


    public function getSrc()
    {
        $faker = Faker\Factory::create();
        return $faker->randomElement([
            "https://lccdn.phphub.org/uploads/images/201806/01/5320/7kG1HekGK6.jpg",
            "https://lccdn.phphub.org/uploads/images/201806/01/5320/1B3n0ATKrn.jpg",
            "https://lccdn.phphub.org/uploads/images/201806/01/5320/r3BNRe4zXG.jpg",
            "https://lccdn.phphub.org/uploads/images/201806/01/5320/C0bVuKB2nt.jpg",
            "https://lccdn.phphub.org/uploads/images/201806/01/5320/82Wf2sg8gM.jpg",
            "https://lccdn.phphub.org/uploads/images/201806/01/5320/nIvBAQO5Pj.jpg",
            "https://lccdn.phphub.org/uploads/images/201806/01/5320/XrtIwzrxj7.jpg",
            "https://lccdn.phphub.org/uploads/images/201806/01/5320/uYEHCJ1oRp.jpg",
            "https://lccdn.phphub.org/uploads/images/201806/01/5320/2JMRaFwRpo.jpg",
            "https://lccdn.phphub.org/uploads/images/201806/01/5320/pa7DrV43Mw.jpg",
        ]);
    }
}
