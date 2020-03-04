<?php

namespace App;

use App\Http\Controllers\Concern\UuidAsPrimary;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use UuidAsPrimary;

    public function marioLaps()
    {
        return $this->hasMany(MarioLap::class);
    }
}
