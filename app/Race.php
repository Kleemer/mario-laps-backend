<?php

namespace App;

use App\Http\Controllers\Concern\UuidAsPrimary;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use UuidAsPrimary;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'round_id',
    ];

    public function users()
    {
        return $this->hasMany(UserRace::class);
    }
}
