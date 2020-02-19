<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function users()
    {
        return $this->hasMany(UserRace::class);
    }
}
