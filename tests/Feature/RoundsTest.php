<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\MarioLap;
use App\Race;
use App\Round;
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

    public function testPostRoundKeepWithLapValue()
    {
        $race = factory(Race::class)->create([
            'with_lap' => true,
        ]);
        $round = Round::whereId($race->round_id)->first();

        $response = $this->authUserPost(
            route('post.rounds', [
                'mario_lap_id' => $round->mario_lap_id,
            ])
        )
            ->assertSuccessful();

        $newRound = $this->getResponseData($response);

        $this->assertTrue($newRound['races'][0]['with_lap']);
    }
}
