<?php

namespace Tests\Feature;

use App\Race;
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
                    'users' => [
                        '*' => [
                            'id',
                            'position',
                        ],
                    ],
                ],
            ]);
    }

}
