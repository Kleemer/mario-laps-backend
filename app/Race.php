<?php

namespace App;

use App\Traits\UuidAsPrimary;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use UuidAsPrimary;

    public function users()
    {
        return $this->hasMany(UserRace::class);
    }
}
