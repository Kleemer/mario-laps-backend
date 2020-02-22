<?php

namespace App\Http\Controllers;

use App\Http\Resources\RaceResource;
use App\Race;
use App\UserRace;
use Auth;

class UserRaceController extends Controller
{
    public function store(Race $race)
    {
        UserRace::create([
            'user_id' => Auth::user()->id,
            'race_id' => $race->id,
            'position' => request('position'),
        ]);

        return new RaceResource($race->load(['users']));
    }
}
