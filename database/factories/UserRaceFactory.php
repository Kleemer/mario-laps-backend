<?php

use App\Race;
use App\User;
use App\UserRace;
use Faker\Generator as Faker;

$factory->define(UserRace::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'race_id' => function() {
            return factory(Race::class)->create()->id;
        },
        'position' => function() use ($faker) {
            return $faker->randomNumber();
        },
    ];
});
