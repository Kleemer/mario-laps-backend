<?php

declare(strict_types=1);

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
                    'rounds' => [],
                ],
            ]);
    }
}
