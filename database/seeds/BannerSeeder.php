<?php

use Illuminate\Database\Seeder;

use App\Models\Product;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = Faker\Factory::create();

        $pids =  Product::all()->pluck('id')->toArray();

        $ids = [];

        for ($i=0; $i<4; $i++) {
            $ids[$i] = [
                'description' => $factory->word,
                'product_id' => $factory->randomElement($pids)
            ];
        }

        \DB::table('banners')->insert($ids);
    }
}
