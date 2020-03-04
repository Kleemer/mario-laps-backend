<?php

namespace App;

use App\Http\Controllers\Concern\UuidAsPrimary;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use UuidAsPrimary;

    protected $fillable = [
        'session_id',
    ];

    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
