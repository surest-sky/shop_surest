<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/5
 * Time: 20:56
 */

use Faker\Generator as Faker;

$factory->define(App\Models\Admin::class, function (Faker $faker) {
    static $password;
    static $code;

    return [
        'name' => $faker->firstName,
        'password' => $password,
        'salt' => $code,
        'remember_token' => str_random(10),
    ];
});