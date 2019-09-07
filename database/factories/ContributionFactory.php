<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contribution;
use Faker\Generator as Faker;

$factory->define(Contribution::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement([1, 2]),
        'channel_id' => $faker->randomElement([1, 2, 3]),
        'title' => $faker->sentence(),
        'link' => $faker->url(),
        'approved' => 1
    ];
});
