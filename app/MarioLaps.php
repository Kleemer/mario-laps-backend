<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarioLaps extends Model
{
    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
