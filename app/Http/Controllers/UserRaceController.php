<?php

namespace App\Http\Controllers;

use App\Http\Resources\RaceResource;
use App\Race;
use App\UserRace;
use Auth;
use Illuminate\Http\Response;

class UserRaceController extends Controller
{
    public function store(Race $race)
    {
        abort_if(
            UserRace::where('race_id', $race->id)->where('position', request('position'))->exists(),
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        UserRace::create([
            'user_id' => Auth::user()->id,
            'race_id' => $race->id,
            'position' => request('position'),
        ]);

        return new RaceResource($race->load(['users']));
    }
}
