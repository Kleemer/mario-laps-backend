<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoundResource;
use App\Round;
use App\Race;
use App\Rules\RoundRule;

class RoundController extends Controller
{
    public function store()
    {
        request()->validate([
            'mario_lap_id' => [
                'required',
                new RoundRule
            ]
        ]);

        $marioLapId = request('mario_lap_id');

        $round = Round::create([
            'mario_lap_id' => $marioLapId,
        ]);

        Race::create([
            'round_id' => $round->id,
        ]);

        return new RoundResource(
            $round->load(['races'])
        );
    }
}
