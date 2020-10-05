<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\RaceResource;
use App\Race;
use App\Round;
use Illuminate\Http\Response;

class RoundRaceController extends Controller
{
    public function store(Round $round)
    {
        $withLap = false;
        $previousRace = $round->races()->latest()->first();

        // If first Race of this Round
        if (!$previousRace) {
            $roundsCount = $round->marioLap->rounds()->count();
            // Find previous Round and get its last Race
            if ($roundsCount > 1) {
                $previousRound = $round->marioLap->rounds()->latest()->skip(1)->first();
                $withLap = optional($previousRound->races()->latest()->first())->with_lap ?? false;
            }

        } else {
            $withLap = $previousRace->with_lap;
        }

        $newRace = Race::create([
            'round_id' => $round->id,
            'with_lap' => $withLap,
        ]);

        return new RaceResource($newRace);
    }

    public function destroy(Round $round, Race $race)
    {
        $marioLapRoundCount = $round->marioLap->rounds()->count();
        $roundRaceCount = $round->races()->count();

        if ($marioLapRoundCount === 1 && $roundRaceCount === 1) {
            $round->marioLap->delete();
        } else if ($roundRaceCount === 1) {
            $round->delete();
        } else {
            $race->delete();
        }

        return response('', Response::HTTP_NO_CONTENT);
    }
}
