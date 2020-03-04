<?php

namespace Tests\Feature;

use App\Session;
use Illuminate\Http\Response;
use Tests\TestCase;

class RoundsTest extends TestCase
{
    public function testPostRound()
    {
        $this->authUserPost(
            route('post.rounds')
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

    public function testPosRoundWithSessionId()
    {
        $session = factory(Session::class)->create();

        $this->authUserPost(
            route('post.rounds'), [
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

    public function testPostRoundWithInvalidSessionId()
    {
        $this->authUserPost(
            route('post.rounds', [
                'session_id' => 'invalid id',
            ])
        )
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
