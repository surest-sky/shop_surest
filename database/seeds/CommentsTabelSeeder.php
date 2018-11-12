<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Product;

class CommentsTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = Faker\Factory::create();

        $uIds = User::all()->pluck('id')->toArray();
        $pIds = Product::all()->pluck('id')->toArray();

        $arr = [];
        foreach ($pIds as $key=>$pid) {
            $arr[$key]['product_id'] = $pid;
            $arr[$key]['user_id'] = $factory->randomElement($uIds);
            $arr[$key]['rating'] = rand(2,10);
            $arr[$key]['content'] = $factory->text(50);
        }

        \DB::table('comments')->insert($arr);

        $arr = [];
        foreach ($pIds as $key=>$pid) {
            $arr[$key]['product_id'] = $pid;
            $arr[$key]['user_id'] = $factory->randomElement($uIds);
            $arr[$key]['rating'] = rand(2,10);
            $arr[$key]['content'] = $factory->text(50);
        }

        \DB::table('comments')->insert($arr);

    }
}
