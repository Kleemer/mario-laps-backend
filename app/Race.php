<?php

namespace App;

use App\Http\Controllers\Concern\UuidAsPrimary;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use UuidAsPrimary;

    protected $casts = [
        'with_lap' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'round_id',
        'with_lap',
    ];

    public function users()
    {
        return $this->hasMany(UserRace::class);
    }
}
