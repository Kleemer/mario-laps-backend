<?php

namespace App;

use App\Http\Controllers\Concern\UuidAsPrimary;
use Illuminate\Database\Eloquent\Model;

class MarioLap extends Model
{
    use UuidAsPrimary;

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }
}
