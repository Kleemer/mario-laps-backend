<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function players()
    {
        return $this->hasMany(PlayerRace::class);
    }
}
