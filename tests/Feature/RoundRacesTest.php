<?php

namespace Tests\Feature;

use App\Round;
use Tests\TestCase;

class RoundRacesTest extends TestCase
{
    public function testPostRoundRace()
    {
        $round = factory(Round::class)->create();

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
