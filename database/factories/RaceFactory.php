<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MarioLap;
use App\Race;
use Faker\Generator as Faker;

$factory->define(Race::class, function (Faker $faker) {
    $marioLap = factory(MarioLap::class)->create();

    return [
        'mario_lap_id' => $marioLap->id,
    ];
});
