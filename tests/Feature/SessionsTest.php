<?php

namespace Tests\Feature;

use App\Round;
use App\Session;
use Carbon\Carbon;
use Tests\TestCase;

class SessionsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetSessions()
    {
        // Inactive sessions
        Carbon::setTestNow(Carbon::now()->subHours(30));
        factory(Session::class, 2)->create([
            'created_at' => Carbon::now(),
        ]);

        Carbon::setTestNow();
        $activeSession = factory(Session::class)->create([
            'created_at' => Carbon::now(),
        ]);

        factory(Round::class)->create([
            'session_id' => $activeSession->id,
        ]);


        $this->authUserGet(
            route('get.active_sessions')
        )
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'rounds',
                        'created_at',
                    ],
                ],
            ])
            ->assertJsonCount(1, 'data');
    }
}
