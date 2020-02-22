<?php

namespace Tests\Feature;

use App\MarioLap;
use Tests\TestCase;

class MarioLapRacesTest extends TestCase
{
    public function testPostMarioLapRace()
    {
        $marioLap = factory(MarioLap::class)->create();

        $countRace = $marioLap->races()->count();

        $this->authUserPost(
            route('post.mariolaps.races', [
                'marioLap' => $marioLap->id,
            ])
        )
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'races',
                ],
            ])
            ->assertJsonCount($countRace + 1, 'data.races');
    }
}
