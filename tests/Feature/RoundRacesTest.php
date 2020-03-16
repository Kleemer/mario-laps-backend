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
                    'races',
                ],
            ])
            ->assertJsonCount($countRace + 1, 'data.races');
    }
}
