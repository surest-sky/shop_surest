<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        factory(App\Models\Product::class)->times(50)->create()
            ->each(function ($product) use ($faker){
                $temp = [];
                for($i=0; $i<3; $i++){
                    $price = random_int(1,9999);
                    array_push($temp,$price);
                    $skus[] = [
                        'name' => $faker->name,
                        'description' => $faker->sentence,
                        'stock' => 999,
                        'price' => $price,
                        'product_id'=> $product->id
                    ];
                }
                Product::find($product->id)->update([
                    'price' => min($temp)
                ]);
                \DB::table('product_skus')->insert($skus);
            });
    }
}
