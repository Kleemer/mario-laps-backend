<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MarioLap;
use App\Round;
use Faker\Generator as Faker;

$factory->define(Round::class, function (Faker $faker) {
    return [
        'mario_lap_id' => function () {
            return factory(MarioLap::class)->create()->id;
        },
    ];
});
