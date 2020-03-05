<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\MarioLapResource;
use App\MarioLap;
use App\Race;
use App\Round;

class MarioLapController extends Controller
{
    public function store()
    {
        $marioLap = MarioLap::create();

        $round = Round::create([
            'mario_lap_id' => $marioLap->id,
        ]);

        Race::create([
            'round_id' => $round->id,
        ]);

        return new MarioLapResource($marioLap->load(['rounds.races']));
    }
}
