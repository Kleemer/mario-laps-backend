<?php

namespace Tests\Feature;

use App\Race;
use Tests\TestCase;

class RaceLapsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPatchRaceLap()
    {
        $race = factory(Race::class)->create();

        $this->authUserPatch(
            route('patch.races.lap', [
                'race' => $race->id,
                'with_lap' => true,
            ])
        )
            ->assertSuccessful();
    }
}
