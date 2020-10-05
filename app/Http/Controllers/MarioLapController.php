<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\MarioLapResource;
use App\MarioLap;

class MarioLapController extends Controller
{
    public function store()
    {
        $marioLap = MarioLap::create();

        return new MarioLapResource($marioLap);
    }
}
