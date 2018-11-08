<?php

use Faker\Generator as Faker;
use App\Models\Product;
use App\Models\ProductSku;

$factory->define(ProductSku::class, function (Faker $faker) {

    $pIds = Product::all()->pluck('id')->toArray();

    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'stock' => 999,
        'price' => random_int(1,9999),
        'review_count' => 0,
        'product_id'=>$faker->randomElement($pIds)
    ];
});
