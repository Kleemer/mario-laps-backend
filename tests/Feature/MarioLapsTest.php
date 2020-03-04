<?php

namespace Tests\Feature;

use App\MarioLap;
use App\Round;
use Carbon\Carbon;
use Tests\TestCase;

class MarioLapsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetMarioLaps()
    {
        // Inactive mario laps
        Carbon::setTestNow(Carbon::now()->subHours(30));
        factory(MarioLap::class, 2)->create([
            'created_at' => Carbon::now(),
        ]);

        Carbon::setTestNow();
        $activeMarioLap = factory(MarioLap::class)->create([
            'created_at' => Carbon::now(),
        ]);

        factory(Round::class)->create([
            'mario_lap_id' => $activeMarioLap->id,
        ]);


        $this->authUserGet(
            route('get.active_mario_laps')
        )
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'rounds',
                        'created_at',
                    ],
                ],
            ])
            ->assertJsonCount(1, 'data');
    }
}
