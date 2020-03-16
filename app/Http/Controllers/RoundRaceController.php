<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoundResource;
use App\Race;
use App\Round;

class RoundRaceController extends Controller
{
    public function store(Round $round)
    {
        $previousRace = $round->races()->latest()->first();

        Race::create([
            'round_id' => $round->id,
            'with_lap' => $previousRace->with_lap,
        ]);

        return new RoundResource($round->load(['races']));
    }
}
