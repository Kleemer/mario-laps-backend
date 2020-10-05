<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\MarioLap;
use App\Race;
use App\Round;
use Carbon\Carbon;
use Tests\TestCase;

class RoundRacesTest extends TestCase
{
    public function testPostRoundRace()
    {
        $race = factory(Race::class)->create();
        $round = Round::whereId($race->round_id)->first();

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
                    'user_races',
                    'with_lap'
                ],
            ]);

        $newCountRace = $round->races()->count();

        $this->assertSame($newCountRace, $countRace + 1);
    }

    public function testPostRoundRaceKeepWithLapValue()
    {
        $race = factory(Race::class)->create([
            'with_lap' => true,
        ]);
        $round = Round::whereId($race->round_id)->first();

        $response = $this->authUserPost(
            route('post.rounds.races', [
                'round' => $round->id,
            ])
        )
            ->assertSuccessful();

        $newRace = $this->getResponseData($response);

        $this->assertTrue($newRace['with_lap']);
    }

    public function testPostRoundRaceKeepWithLapValueFromPreviousRound()
    {
        $race = factory(Race::class)->create([
            'with_lap' => true,
        ]);

        $previousRound = Round::whereId($race->round_id)->first();

        $round = factory(Round::class)->create([
            'mario_lap_id' => $previousRound->mario_lap_id,
            'created_at' => Carbon::now()->addSecond(),
            'updated_at' => Carbon::now()->addSecond()
        ]);

        $response = $this->authUserPost(
            route('post.rounds.races', [
                'round' => $round->id,
            ])
        )
            ->assertSuccessful();

        $newRace = $this->getResponseData($response);

        $this->assertTrue($newRace['with_lap']);
    }

    public function testDeleteRoundRace()
    {

        $rounds = factory(Round::class, 2)->create();
        $races = factory(Race::class, 3)->create([
            'round_id' => $rounds[0]->id,
        ]);

        $this->assertSame(Race::all()->count(), 3);

        $this->authUserDelete(
            route('delete.rounds.races', [
                'round' => $rounds[0]->id,
                'race' => $races[0]->id,
            ])
        )
            ->assertSuccessful();

            $this->assertSame(Race::all()->count(), 2);
            // Does not delete Round
            $this->assertSame(Round::all()->count(), count($rounds));
        }

    public function testDeleteRaceAndRound()
    {

        $rounds = factory(Round::class, 2)->create();
        $race = factory(Race::class)->create([
            'round_id' => $rounds[0]->id,
        ]);

        $this->assertSame(Round::all()->count(), 2);

        $this->authUserDelete(
            route('delete.rounds.races', [
                'round' => $rounds[0]->id,
                'race' => $race->id,
            ])
        )
            ->assertSuccessful();

        $this->assertSame(Round::all()->count(), 1);
    }

    public function testDeleteRaceAndRoundAndMarioLap()
    {

        $round = factory(Round::class)->create();
        $race = factory(Race::class)->create([
            'round_id' => $round->id,
        ]);

        $this->assertSame(MarioLap::all()->count(), 1);

        $this->authUserDelete(
            route('delete.rounds.races', [
                'round' => $round->id,
                'race' => $race->id,
            ])
        )
            ->assertSuccessful();

        $this->assertSame(MarioLap::all()->count(), 0);
    }
}
