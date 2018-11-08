<?php

use Illuminate\Database\Seeder;

class ProductSkusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Product::class)->times(50)->create();
    }
}
