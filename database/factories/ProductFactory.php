<?php

use Faker\Generator as Faker;
use App\Models\Category;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    $cateIds = Category::all()->pluck('id')->toArray();

    $price = $faker->numberBetween(100,9999);
    $sale = min($price,$faker->numberBetween(100,9999));
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'rating' => $faker->numberBetween(0,5),
        'sold_count' => 0,
        'review_count' => 0,
        'price' => $price,
        'on_sale'=> $sale,
        'category_id'=>$faker->randomElement($cateIds)
    ];
});

