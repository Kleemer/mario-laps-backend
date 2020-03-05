<?php

namespace Tests\Feature;

use App\MarioLap;
use Illuminate\Http\Response;
use Tests\TestCase;

class RoundsTest extends TestCase
{
    public function testPostRoundWithMarioLapId()
    {
        $marioLap = factory(MarioLap::class)->create();

        $this->authUserPost(
            route('post.rounds'), [
                'mario_lap_id' => $marioLap->id,
            ]
        )
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'mario_lap_id',
                    'races',
                ],
            ])
            ->assertJsonCount(1, 'data.races');
    }

    public function testPosRoundWithoutMarioLapId()
    {

        $this->authUserPost(
            route('post.rounds')
        )
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testPostRoundWithInvalidMarioLapId()
    {
        $this->authUserPost(
            route('post.rounds', [
                'mario_lap_id' => 'invalid id',
            ])
        )
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
