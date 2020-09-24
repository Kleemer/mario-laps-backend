<?php

namespace App\Http\Controllers;

use App\Http\Resources\RaceResource;
use App\Race;
use App\RaceType;

class RaceTypeController extends Controller
{
    public function update(Race $race)
    {
        request()->validate([
            'race_type_id' => 'nullable|string',
        ]);

        if (request('race_type_id')) {
            $raceType = RaceType::findOrFail(request('race_type_id'));
            $race->raceType()->associate($raceType)->save();
        } else {
            $race->raceType()->dissociate()->save();
        }


        return new RaceResource($race);
    }
}
