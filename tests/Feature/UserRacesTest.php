<?php

namespace Tests\Feature;

use App\Race;
use App\UserRace;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserRacesTest extends TestCase
{
    public function testPostUserRace()
    {
        $race = factory(Race::class)->create();

        $this->authUserPost(
            route('post.user-races', [
                'race' => $race->id,
                'position' => 1
            ])
        )
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_races' => [
                        '*' => [
                            'id',
                            'position',
                        ],
                    ],
                ],
            ]);
    }

    public function testCannotPostUserRaceIfPositionAlreadyTaken()
    {
        $race = factory(Race::class)->create();
        factory(UserRace::class)->create([
            'race_id' => $race->id,
            'position' => 4,
        ]);

        $this->authUserPost(
            route('post.user-races', [
                'race' => $race->id,
                'position' => 4
            ])
        )
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
