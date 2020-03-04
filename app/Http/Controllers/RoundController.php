<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoundResource;
use App\Round;
use App\Race;
use App\Rules\RoundRule;
use App\Session;

class RoundController extends Controller
{
    public function store()
    {
        request()->validate([
            'session_id' => [
                'sometimes',
                new RoundRule
            ]
        ]);

        $sessionId = request('session_id');

        if (!$sessionId) {
            $sessionId = Session::create()->id;
        }

        $round = Round::create([
            'session_id' => $sessionId,
        ]);

        Race::create([
            'round_id' => $round->id,
        ]);

        return new RoundResource(
            $round->load(['races'])
        );
    }
}
