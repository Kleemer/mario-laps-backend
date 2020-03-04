<?php

namespace App;

use App\Http\Controllers\Concern\UuidAsPrimary;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use UuidAsPrimary;

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }
}
