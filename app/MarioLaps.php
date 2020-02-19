<?php

namespace App;

use App\Http\Controllers\Concern\UuidAsPrimary;
use Illuminate\Database\Eloquent\Model;

class MarioLaps extends Model
{
    use UuidAsPrimary;

    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
