<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use App\Models\Wish;

class WishTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = User::all()->pluck('id')->toArray();
        $pIds = Product::all()->pluck('id')->toArray();

        $wishs  = [];

        $count = count($userIds);

        for ( $i=0; $i<$count; $i++ ) {
            $wishs[$i]['user_id'] = $userIds[$i];
            $wishs[$i]['product_ids'] = json_encode(collect($pIds)->random(5)->all());
        }
        \DB::table('wishes')->insert($wishs);

    }
}
