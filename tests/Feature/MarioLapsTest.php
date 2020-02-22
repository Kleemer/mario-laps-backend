<?php

namespace Tests\Feature;

use Tests\TestCase;

class MarioLapsTest extends TestCase
{
    public function testPostMarioLap()
    {
        $this->authUserPost(
            route('post.mariolaps')
        )
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'races',
                ],
            ])
            ->assertJsonCount(1, 'data.races');
    }
}
