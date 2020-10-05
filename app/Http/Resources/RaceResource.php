<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'round_id' => $this->round_id,
            'user_races' => UserRaceResource::collection($this->users),
            'with_lap' => $this->with_lap,
            'race_type' => new RaceTypeResource($this->raceType),
        ];
    }
}
