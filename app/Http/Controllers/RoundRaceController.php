<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoundResource;
use App\Race;
use App\Round;

class RoundRaceController extends Controller
{
    public function store(Round $round)
    {
        Race::create([
            'round_id' => $round->id,
        ]);

        return new RoundResource($round->load(['races']));
    }
}
