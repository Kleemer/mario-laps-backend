<?php

namespace Tests\Feature;

use App\Race;
use App\Round;
use Tests\TestCase;

class RoundRacesTest extends TestCase
{
    public function testPostRoundRace()
    {
        $race = factory(Race::class)->create();
        $round = Round::whereId($race->round_id)->first();

        $countRace = $round->races()->count();

        $this->authUserPost(
            route('post.rounds.races', [
                'round' => $round->id,
            ])
        )
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_races',
                    'with_lap'
                ],
            ]);

        $newCountRace = $round->races()->count();

        $this->assertSame($newCountRace, $countRace + 1);
    }
}
