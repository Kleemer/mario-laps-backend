<?php

use App\Player;
use Faker\Generator as Faker;

$factory->define(Player::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'avatar' => $faker->url
    ];
});
