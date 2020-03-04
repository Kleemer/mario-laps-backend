<?php

namespace Tests\Feature;

use App\Session;
use Illuminate\Http\Response;
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
                    'session_id',
                    'races',
                ],
            ])
            ->assertJsonCount(1, 'data.races');
    }

    public function testPostMarioLapWithSessionId()
    {
        $session = factory(Session::class)->create();

        $this->authUserPost(
            route('post.mariolaps'), [
                'session_id' => $session->id,
            ]
        )
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'session_id',
                    'races',
                ],
            ])
            ->assertJsonCount(1, 'data.races');
    }

    public function testPostMarioLapWithInvalidSessionId()
    {
        $this->authUserPost(
            route('post.mariolaps', [
                'session_id' => 'invalid id',
            ])
        )
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
