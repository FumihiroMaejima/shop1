<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Goods::class, function (Faker $faker) {
    return [
        'goods_code' => $faker->unique()->bothify('???###'),
        'goods_name' => $faker->unique()->lexify('Goods????'),
        'standard' => $faker->unique()->bothify('###???'),
        'price' => $faker->unique()->numberBetween($min = 800, $max = 20000),
        'maker' => $faker->unique()->company,
        'release_date' => $faker->unique()->dateTimeThisMonth($max = 'now', $timezone = 'Asia/Tokyo'),
        'handling_date' => $faker->unique()->dateTimeBetween($startDate = '-5 days', $endDate = 'now', $timezone = 'Asia/Tokyo')
    ];
});
