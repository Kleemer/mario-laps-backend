<?php

namespace Tests\Feature;

use App\Race;
use App\RaceType;
use Illuminate\Http\Response;
use Tests\TestCase;

class RaceTypesTest extends TestCase
{
    public function testPatchRaceType()
    {
        $race = factory(Race::class)->create();
        $raceType = RaceType::first();

        $this->authUserPatch(
            route('patch.races.type', [
                'race' => $race->id,
                'race_type_id' => $raceType->id,
            ])
        )
            ->assertSuccessful();
    }

    public function testPatchRaceTypeUnsetType()
    {
        $raceType = RaceType::first();
        $race = factory(Race::class)->create([
            'race_type_id' => $raceType->id,
        ]);

        $this->authUserPatch(
            route('patch.races.type', [
                'race' => $race->id,
                'race_type_id' => null,
            ])
        )
            ->assertSuccessful();
    }

    public function testPatchRaceTypeFailsIfIncorrectTypeId()
    {
        $race = factory(Race::class)->create();

        $this->authUserPatch(
            route('patch.races.type', [
                'race' => $race->id,
                'race_type_id' => 'incorrect type id',
            ])
        )
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
