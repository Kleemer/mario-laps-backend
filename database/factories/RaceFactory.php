<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Race;
use App\Round;
use Faker\Generator as Faker;

$factory->define(Race::class, function (Faker $faker) {
    return [
        'round_id' => function() {
            return factory(Round::class)->create()->id;
        },
        'with_lap' => function() {
            return false;
        },
    ];
});
