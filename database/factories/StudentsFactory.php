<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Students::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'tel' => $faker->unique()->tollFreePhoneNumber,
    ];
});
