<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\RoundResource;
use App\MarioLap;
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
        $marioLap = MarioLap::whereId($marioLapId)->first();
        $withLap = false;

        $roundsCount = $marioLap->rounds()->count();
        // Find previous Round and get its last Race
        if ($roundsCount > 0) {
            $previousRound = $marioLap->rounds()->latest()->first();
            $withLap = optional($previousRound->races()->latest()->first())->with_lap ?? false;
        }

        $round = Round::create([
            'mario_lap_id' => $marioLapId,
        ]);

        Race::create([
            'round_id' => $round->id,
            'with_lap' => $withLap,
        ]);

        return new RoundResource(
            $round->load(['races'])
        );
    }
}
