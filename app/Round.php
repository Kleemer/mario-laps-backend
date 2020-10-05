<?php

declare(strict_types=1);

namespace App;

use App\Http\Controllers\Concern\UuidAsPrimary;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use UuidAsPrimary;

    protected $fillable = [
        'mario_lap_id',
    ];

    public function marioLap()
    {
        return $this->belongsTo(MarioLap::class);
    }

    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
