<?php

namespace Tests\Feature;

use Tests\TestCase;

class MarioLapsTest extends TestCase
{
    public function testPostMarioLap()
    {
        $this->authUserPost(
            route('post.mario_laps')
        )
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'rounds' => [
                        '*' => [
                            'id',
                            'mario_lap_id',
                            'races' => [
                                '*' => [
                                    'id',
                                    'user_races'
                                ]
                            ]
                        ]
                    ],
                ],
            ]);
    }
}
