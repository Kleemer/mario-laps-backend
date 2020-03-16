<?php

namespace App\Http\Controllers;

use App\Http\Resources\RaceResource;
use App\Race;

class RaceLapController extends Controller
{
    public function update(Race $race)
    {
        request()->validate([
            'with_lap' => 'required|boolean',
        ]);

        $race->with_lap = request('with_lap');
        $race->save();

        return new RaceResource($race);
    }
}
