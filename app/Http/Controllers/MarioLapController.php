<?php

namespace App\Http\Controllers;

use App\Http\Resources\MarioLapResource;
use App\MarioLap;
use App\Race;
use App\Rules\MarioLapRule;
use App\Session;

class MarioLapController extends Controller
{
    public function store()
    {
        request()->validate([
            'session_id' => [
                'sometimes',
                new MarioLapRule
            ]
        ]);

        $sessionId = request('session_id');

        if (!$sessionId) {
            $sessionId = Session::create()->id;
        }

        $marioLap = MarioLap::create([
            'session_id' => $sessionId,
        ]);

        Race::create([
            'mario_lap_id' => $marioLap->id,
        ]);

        return new MarioLapResource(
            $marioLap->load(['races'])
        );
    }
}
