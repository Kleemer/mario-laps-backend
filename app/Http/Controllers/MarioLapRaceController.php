<?php

namespace App\Http\Controllers;

use App\Http\Resources\MarioLapResource;
use App\MarioLap;
use App\Race;

class MarioLapRaceController extends Controller
{
    public function store(MarioLap $marioLap)
    {
        Race::create([
            'mario_lap_id' => $marioLap->id,
        ]);

        return new MarioLapResource($marioLap->load(['races']));
    }
}
