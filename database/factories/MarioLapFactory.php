<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MarioLap;
use App\Session;
use Faker\Generator as Faker;

$factory->define(MarioLap::class, function (Faker $faker) {
    return [
        'session_id' => function (){
            return factory(Session::class)->create()->id;
        },
    ];
});
