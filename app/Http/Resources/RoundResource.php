<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoundResource extends JsonResource
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
            'mario_lap_id' => $this->mario_lap_id,
            'races' => RaceResource::collection($this->races),
            'created_at' => $this->created_at->toIso8601ZuluString(),
        ];
    }
}
