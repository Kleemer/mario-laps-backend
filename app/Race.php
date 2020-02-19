<?php

namespace App;

use App\Http\Controllers\Concern\UuidAsPrimary;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use UuidAsPrimary;

    public function users()
    {
        return $this->hasMany(UserRace::class);
    }
}
